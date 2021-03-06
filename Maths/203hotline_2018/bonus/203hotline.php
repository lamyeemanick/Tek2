<?php
include ('index.php');

function print_usage()
{
  $usage = "USAGE\n\t./203hotline [n k | d]\n";
  $usage .= "\nDESCRIPTION\n\t";
  $usage .= "n\tn value for the computation of (n k)\n\t";
  $usage .= "k\tk value for the computation of (n k)\n\t";
  $usage .= "d\taverage duration of calls (in seconds)\n";
  echo $usage;
  return (0);
}

function error_handling_d($argv)
{
  if (!is_numeric($argv[1]))
  return (84);
  if (intval($argv[1]) < 0)
  return (84);
  return (0);
}

function error_handling_nk($argv)
{
  if (!is_numeric($argv[1]) || !is_numeric($argv[2]))
  return (84);
  return (0);
}

function factoriel($val)
{
  if ($val == 0)
  return (1);
  return (($val > 1) ? bcmul($val, factoriel(bcsub($val, 1))) : $val);
}

function combination($k, $n)
{
  return (bcdiv(factoriel($n), (bcmul(factoriel(bcsub($n, $k)), factoriel($k)))));
}

function get_time()
{
  $time = microtime();
  $time = explode(" ", $time);
  $time = $time[1] + $time[0];
  return ($time);
}

function fact($n, $k)
{
  $res = 1;
  for ($i = $n; $i > ($n - $k); $i--)
  $res *= $i;
  return ($res);
}

function coef_binomial($n, $k)
{
  $res = fact($n, $k) / factoriel($k);
  return ($res);
}

function binomial_law($d, $poisson)
{
  $p = $d / (8 * 3600);
  $starttime = get_time();
  for ($i = 0; $i != 51; $i++)
  $poisson[$i] = coef_binomial(3500, $i) * pow($p, $i) * pow((1 - $p), (3500 - $i));
  $endtime = get_time();
  for ($i = 0; $i != 51; $i++) {
    if ($i % 6 == 0)
    printf("\n%d -> %.3f", $i, $poisson[$i]);
    else
    printf("\t%d -> %.3f", $i, $poisson[$i]);
  }  
  $sum = 0;
  for ($k = 26; $k != 51; $k++)
  $sum += $poisson[$k];
  printf("\noverload: %.1f%%\n", $sum * 100);
  printf("computation time: %.2f ms\n", ($endtime - $starttime) * 1000);
}

function poisson_law($d, $poisson)
{
  $lambda = $d / (8 * 3600 / 3500);
  $e = "2.7182818284590452353602874";
  
  $lambda = floatval($lambda);
  $mlambda = $lambda * -1;
  $starttime = get_time();
  for ($i = 0; $i != 51; $i++)
  $poisson[$i] = (pow($lambda, $i) * pow($e, $mlambda)) / factoriel($i);
  $endtime = get_time();
  for ($i = 0; $i != 51; $i++) {
    if ($i % 6 == 0)
    printf("\n%d -> %.3f", $i, $poisson[$i]);
    else
    printf("\t%d -> %.3f", $i, $poisson[$i]);
  }
  $sum = 0;
  for ($k = 26; $k != 51; $k++)
  $sum += $poisson[$k];
  printf("\noverload: %.1f%%\n", $sum * 100);
  printf("computation time: %.2f ms\n", ($endtime - $starttime) * 1000);
}

function hotline_d($d)
{
  
  printf("Binomial distribution:");
  printf("\nPoisson distrubution:");
}

function hotline_nk($n, $k)
{
  printf("%s-combination of a %s set:\n", $k, $n);
  return (combination($k, $n));
}

$argc = 2;
$argv[1] = "-h";
$poisson = array_fill(0, 51, 0);

if ($argc == 1 || $argc > 3) {
  print_usage();
}
else if ($argc == 2) {
  if (strcmp($argv[1], "-h") == 0)
  $ret = print_usage();
  else if (error_handling_d($argv) == 84)
  $ret = 84;
  else {
    $bi = binomial_law($d, $poisson);
    $po = poisson_law($d, $poisson);
  }
} else {
  if (error_handling_nk($argv) == 84)
  $ret = 84;
  else
  $ret = hotline_nk($argv[1], $argv[2]);
}
?>

</body>