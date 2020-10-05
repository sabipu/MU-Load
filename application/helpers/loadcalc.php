<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('loadcalc'))
{
  /**
   * ngLoadCalc
   *
   * Converts the string into formula based on the satisfied criteria of variables
   * If the element is empty it returns NULL (or whatever you specify as the default value.)
   * 
   *
   * @param string  $target String to formulate. Metric
   * @param string or JSON String.  $data Data for the variables. Example: Single: "4" Multiple: "3,5,8"
   * @return  integer
   */

  function ngLoadCalc($target = null, $data = null)
  {
    $target = ngClean($target);
    if ($data == "") {
      @eval('$myResult = '.$target.';');
      $myResult = ngReturnFloat($myResult);
      return $myResult;
    }else{
      $data = @ngExplode(ngClean($data));
      if ($data) {
        if (count(ngLoadVarCount($target)) == count($data)) {
          if ($target != null || $target != "") {
            return @ngDoCalc($target,$data);  
          }else{
            return "The metric is empty.";
          } 
        }else{
          return "Variables not defined";
        }
      }else{
        return "Error";
      } 
    }
    
  }

  function ngLoadMetricCheck($target)
  {
    $target = ngClean($target);
    $target = preg_replace("/[^a-zA-Z0-9.*\-+\/()]/i", "", $target);
    $array = str_split($target);
    $counter = 0;
    foreach ($array as $item) {
      if (ngCheckIfParenthesis($item)) {
        $counter++;
      }
    }
    if ($counter % 2 == 0 || $counter == 0) {
      return true;
    }else{
      return false;
    }
  }

  /*Find the number of variables/alphabet in formula*/
  function ngLoadVarCount($target)
  {
    $alphaVar = array();
    if (ngClean($target) != "") {
      $a = str_split(ngClean($target));
      foreach ($a as $key => $value) {
        if (ctype_alpha($value)) {
          array_push($alphaVar, $value);
        }
      }
    }
    return $alphaVar;
  }

  // Compares the result with the expected answer.
  // Return bool
  function ngLoadCalcTest($target, $data, $expect)
  {
    $result = @ngLoadCalc($target, $data);
    if (trim($expect) === trim((string)$result)) {
      return true;
    }else{
      return false;
    }
  }


  function ngDoCalc($target, $data)
  {
    /*echo "PROCESSED<br>";
    echo $target."<br><br>";*/
    if (ngCheckP($target)) {
      list($openP, $closeP) = ngFindP($target);

      $parenthesisBlock = ngSubstr($target,$openP,$closeP);
      $parenthesisBlockClean = substr($parenthesisBlock, 1, -1);
      list($calcBlock, $data) = ngDoEval($parenthesisBlockClean, $data);

      $target = ngRearrange($target, $calcBlock, $openP, $closeP);
      $myResult = ngDoCalc($target, $data);
    }else{
      list($calcBlock, $data) = ngDoEval($target, $data);
      @eval('$myResult = '.$calcBlock.';');
    }
    return ngReturnFloat($myResult);
  }

  function ngRearrange($mString,$calcBlock, $openP, $closeP)
  {
    $a = substr($mString, 0, $openP);
    $b = substr($mString, $closeP+1, strlen($mString));
    $result = $a . (string)$calcBlock . $b;
    return $result;
  }

  function ngCheckP($string)
  {
    $status = false;
    $array = str_split($string);
    foreach ($array as $key => $value) {
      if (ngCheckIfParenthesis($value)) {
        $status = true;
        break;
      }
    }
    return $status;
  }

  function ngFindP($string)
  {
    $array = str_split($string);
    foreach ($array as $key => $value) {
      if (ngCheckIfParenthesis($value)) {
        if ($value === "(") {
          $fo = $key;
        }
        if ($value === ")") {
          $fc = $key;
          break;
        }
      }
    }
    return array ($fo, $fc);
  }


  function ngDoEval($target, $targetValue)
  {
    $a = str_split($target);
    $evalString = "";
    foreach ($a as $key => $value) {
      if(ctype_alpha($value)){
        $evalString = $evalString . strval($targetValue[0]);
        array_splice($targetValue, 0, 1);
      }else{
        $evalString = $evalString . $value;
      }
    }
    @eval('$result = '.$evalString.';');
    return array($result, $targetValue);
  }

  function ngSubstr($string, $start, $end)
  {
    $string =  substr($string, $start, ($end-$start) + 1);
    return $string;
  }

  function ngCheckIfParenthesis($a)
  {
    if($a === "(" || $a === ")"){ return true;}else{ return false; }
  }

  function ngVisualizationChar($a)
  {
    $array = str_split($a);
    echo "<table ><tr>";
    foreach ($array as $key => $value) {
      echo "<td style='border:1px solid #000; padding: 5px;'>".$value."</td>";
    }
    echo ("</tr><tr>");
    foreach ($array as $key => $value) {
      echo "<td style='border:1px solid #000; padding: 5px;'>".$key."</td>";
    }
    echo ("</tr></table>");
  }

  function ngExplode($a)
  {
    if (is_string($a)) {
      $a = preg_replace("/[^0-9,.]/i", "", $a);
      $a = explode(',', $a);
      return $a;  
    }else{
      return false;
    }
  }

  function ngClean($a)
  {
    $a = str_replace(' ', '', $a);
    return $a;
  }

  function ngReturnFloat($a)
  {
    if (is_float($a)) {
      $result = round($a, 2);
      $result = $result + 0 ;
      return $result;
    }else{
      return $a;
    }
  }
}