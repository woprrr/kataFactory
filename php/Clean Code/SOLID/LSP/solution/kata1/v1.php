<?php

use PHPUnit\Framework\TestCase;

class HtmlFormatterTest extends TestCase
{
    public function testFormatWithReport()
    {
        $report = new Report("18/06/2023", "Liskov Help me", ["keepCalm", "Breath", "Love Woprrr"]);
        $htmlFormatter = new HtmlFormatter();
        $expected = "
        <h2>Liskov Help me</h2>
        <em>Date : 18/06/2023</em>
        <h4>Données :</h4>
        <ul>
          <li>keepCalm</li>
          <li>Breath</li>
          <li>Love Woprrr</li>
        </ul>
        ";

        $this->assertEquals($expected, $htmlFormatter->format($report));
    }

    public function testFormatWithStringReport()
    {
        $stringReport = new StringReport("18/06/2023", "Liskov Help me", ["keepCalm", "Breath", "Love Woprrr"]);
        $htmlFormatter = new HtmlFormatter();
        $expected = "keepCalm, Breath, Love Woprrr";

        $this->assertEquals($expected, $htmlFormatter->format($stringReport));
    }
}

interface Reportable {
  public function getContent(): array;
}

interface Stringify {
  public function getStringContent(): string;
}

class Report implements Reportable {
  public function __construct(
    private string $date,
    private string $title,
    protected array $data,
  ) {}

  public function getContent(): array
  {
    return [
      'date' => $this->date,
      'title' => $this->title,
      'data' => $this->data,
    ];
  }
}

class StringReport extends Report implements Stringify {
    public function getStringContent(): string
    {
      return implode(', ', $this->data);
    }
}

class HtmlFormatter {
  public function format(Report $report)
  {
    if ($report instanceof StringReport) {
        return $report->getStringContent();
    }

    $content = $report->getContent();

    $data = "";
    foreach ($content['data'] as $value) {
      $data .= "<li>$value</li>";
    }

    return "
    <h2>{$content['title']}</h2>
    <em>Date : {$content['date']}</em>
    <h4>Données :</h4>
    <ul>
      $data
    </ul>
    ";
  }
}

$report1 = new Report("18/06/2023", "Liskov Help me", ["keepCalm", "Breath", "Love Woprrr"]);
$report2 = new StringReport("18/06/2023", "Liskov Help me", ["keepCalm", "Breath", "Love Woprrr"]);
$htmlFormater = new HtmlFormatter();
$reportResult1 = $htmlFormater->format($report1);
$reportResult2 = $htmlFormater->format($report2);
var_dump("report 1 : {$reportResult1}", "report2 : {$reportResult2}");
