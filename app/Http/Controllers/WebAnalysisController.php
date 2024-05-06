<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\ContentRules;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;

class WebAnalysisController extends Controller
{
    public function index()
    {
        return view('analyze');
    }

    private function getSeoAnalysis($url)
    {
        $apiKey = env('AIzaSyCKAtvEM25OhCKJom-KuYLTzk3ee_UKNxQ');
        $googleUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&key={$apiKey}";

        $client = new Client();
        $response = $client->request('GET', $googleUrl);

        return json_decode($response->getBody(), true);
    }

    public function analyze(Request $request)
    {
        $url = $request->input('url');

        if (empty($url) || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return view('index', [
                'result' => false,
                'message' => 'Invalid URL provided.'
            ]);
        }

        $client = new Client();
        try {
            $response = $client->request('GET', $url);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return view('index', [
                'result' => false,
                'message' => 'Failed to retrieve the URL. Error: ' . $e->getMessage()
            ]);
        } catch (\Exception $e) {
            return view('index', [
                'result' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }

        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        $seoData = $this->extractSeoData($crawler);
        $bodyText = $crawler->filter('body')->text();
        $classification = $this->applyRules($bodyText);
        $favicon = $this->extractFavicon($crawler, $url);
        $logo = $this->extractLogo($crawler, $url);
        $pageSpeedResults = $this->getSeoAnalysis($url);

        return view('index', [
            'result' => true,
            'url' => $url,
            'seoData' => $seoData,
            'classification' => $classification,
            'pageSpeedResults' => $pageSpeedResults,
            'favicon' => $favicon,
            'logo' => $logo,
        ]);
    }

    private function extractFavicon(Crawler $crawler, $base_url)
    {
        $favicon = $crawler->filter('link[rel="shortcut icon"], link[rel="icon"], link[rel="apple-touch-icon"]')->first();
        if ($favicon->count()) {
            return $this->resolveUrl($favicon->attr('href'), $base_url);
        }
        return 'No favicon found';
    }

    private function extractLogo(Crawler $crawler, $base_url)
    {
        $logo = $crawler->filter('img.logo, img[alt="logo"], img[alt*="Logo"]')->first();
        if ($logo->count()) {
            return $this->resolveUrl($logo->attr('src'), $base_url);
        }
        return false;
    }

    private function resolveUrl($path, $base_url)
    {
        return filter_var($path, FILTER_VALIDATE_URL) ? $path : $base_url . '/' . ltrim($path, '/');
    }

    private function applyRules($text)
    {
        $rules = ContentRules::rules();
        $text = strtolower($text);

        $categoryCount = [];

        foreach ($rules as $category => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($text, $keyword) !== false) {
                    if (!isset($categoryCount[$category])) {
                        $categoryCount[$category] = 0;
                    }
                    $categoryCount[$category]++;
                }
            }
        }

        if (!empty($categoryCount)) {
            $maxCategory = array_keys($categoryCount, max($categoryCount));
            return implode(", ", $maxCategory);
        }

        return "Kategori tidak ditemukan.";
    }

    private function extractSeoData(Crawler $crawler)
    {
        $title = $crawler->filter('title')->first()->text();
        $description = $crawler->filterXpath("//meta[@name='description']")->attr('content');
        $h1Tags = $crawler->filter('h1')->each(function ($node) {
            return $node->text();
        });

        return [
            'title' => $title,
            'description' => $description,
            'h1Tags' => $h1Tags
        ];
    }
}
