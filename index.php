<?php
require 'calendar.php';

function h($g)
{
  return htmlspecialchars($g, ENT_QUOTES, 'UTF-8');
}

$calendar = new \MyApp\Calendar();
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
        <th><a href="/calendar/?t=<?php echo h($calendar->prev); ?>">&laquo;</a></th>
        <th colspan="5"><?php echo h($calendar->yearMonth); ?></th>
        <th><a href="/calendar/?t=<?php echo h($calendar->next); ?>">&raquo;</a></th>
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
      <?php echo $calendar->show(); ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="7"><a href="/calendar/">Today</a></th>
      </tr>
    </tfoot>
  </table>
</body>

</html>