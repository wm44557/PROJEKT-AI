<h1>
    Statystki

</h1>
<br>
<h2>Podsumowanie wszystkich lat</h2><br>
<?php echo "<h4>Ilość faktur w systemie: ".$results['countRecords']->countRecords."</h4>"; ?><br>
<?php echo "<h4>Przychód brutto: ".$results['sumProceeds']->sum_brutto."</h4>"; ?><br>
<?php echo "<h4>Koszty brutto: ".$results['sumCosts']->sum_brutto."</h4>"; ?><br>
<?php echo "<h4>Dochód brutto: ".($results['sumProceeds']->sum_brutto-$results['sumCosts']->sum_brutto)."</h4>"; ?><br>
<br>
<table>
    <thead>
        <th>Rok</th>
        <th>Miesiac</th>
        <th>suma</th>
    </thead>
    <tbody>
        <?php foreach($results['monthlyBiling']['sale'] as $result) {
            echo "<tr>";
            echo "    <td>" . $result->Rok . "</td>";
            echo "    <td>" . $result->Miesiac . "</td>";
            echo "    <td>" . $result->Suma_miesiaca . "</td>";
            echo " </tr>";
        }
        ?>
    </tbody>
</table>


<?php //echo "<h4>Suma Netto wszystkich faktur: ".$results['monthlyBiling']->monthly."</h4>"; ?>
<br>
<?php  //include STATIC_COMPONENT.'\pages\components\statsList.php'; ?>







