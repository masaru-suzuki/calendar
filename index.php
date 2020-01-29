<?php
try {
  if (!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])) {
    throw new Exception();
  }
  $thisMonth = new DateTime($_GET['t']);
} catch (Exception $e) {
  $thisMonth = new DateTime('first day of this month');
}

$yearMonth = $thisMonth->format('F Y');
$body = '';
$period = new DatePeriod(
  new DateTime('first day of' . $yearMonth),
  new DateInterval('P1D'),
  new DateTime('first day of' . $yearMonth . '+1 month')
);
foreach ($period as $day) {
  if ($day->format('w') == 0) {
    //</tr>から始める！
    $body .= '</tr><tr>';
  }
  $body .= sprintf('<td class="youbi_%d">%d</td>', $day->format('w'), $day->format('d'));
}
$head = '';
$firstDayOfNextMonth = new DateTime('first day of' . $yearMonth . '+1 month');
while ($firstDayOfNextMonth->format('w') > 0) {
  $head .= sprintf('<td class="gray">%d</td>', $firstDayOfNextMonth->format('d'));
  $firstDayOfNextMonth->add(new DateInterval('P1D'));
}
$prev = '';
$lastDayOfPrevMonth = new DateTime('last day of' . $yearMonth . '-1 month');
while ($lastDayOfPrevMonth->format('w') < 6) {
  $prev = sprintf('<td class="gray">%d</td>', $lastDayOfPrevMonth->format('d'))  . $prev;
  $lastDayOfPrevMonth->sub(new DateInterval('P1D'));
}

$html = '<tr>' . $prev . $body . $head . '</tr>';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>Calendar</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <table>
    <thead>
      <tr>
        <th><a href="">&laquo;</a></th>
        <th colspan="5"><?php echo $yearMonth; ?></th>
        <th><a href="">&raquo;</a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Sun</td>
        <td>Mon</td>
        <td>Tue</td>
        <td>Wed</td>
        <td>Thu</td>
        <td>Fri</td>
        <td>Sat</td>
      </tr>
      <?php echo $html; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="7"><a href="">Today</a></th>
      </tr>
    </tfoot>
  </table>
</body>

</html>