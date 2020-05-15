<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Container.php");

class Picture extends Container 
{
  private $Link;
  private $Repeat;
  private $Position;
  private $Size;

  function __construct() {
    parent::__construct();
    $this->Link = Url("https://www.selikoff.net/blog-files/null-value.gif");
  }

  function SetLink(string $string) {
    $this->Link = $string;
    return $this;
  }

  function SetRepeat(string $string) {
    $this->Repeat = $string;
    return $this;
  }

  function SetPosition(string $string) {
    $this->Position = $string;
    return $this;
  }

  function SetSize(string $string) {
    $this->Size = $string;
    return $this;
  }

  function GetLink() : string {
    return $this->Link;
  }

  function GetRepeat() : string {
    return $this->Repeat;
  }

  function GetPosition() : string {
    return $this->Position;
  }

  function GetSize() : string {
    return $this->Size;
  }

  function GetArguments(): array {
    $args = parent::GetArguments();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $arg->AddItem(BackgroundImage, $this->Link);
        $arg->AddItem(BackgroundRepeat, $this->Repeat);
        $arg->AddItem(BackgroundPosition, $this->Position);
        $arg->AddItem(BackgroundSize, $this->Size);
        break;
      }
    } 
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments())
    ->SetChild($this->GetChild())
    ->Generate();
  }
}