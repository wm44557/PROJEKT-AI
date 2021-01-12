<div class="box">
    <h1>
        Statystki
    </h1>
    <br>
    <div class="stats-box">
        <h2>Podsumowanie wszystkich lat</h2><br>
        <?php echo "Ilość faktur w systemie: <h4>".$results['countRecords']->countRecords."</h4>"; ?><br>
        <?php echo "Przychód brutto: <h4>".$results['sumProceeds']->sum_brutto."</h4>"; ?><br>
        <?php echo "Koszty brutto: <h4>".$results['sumCosts']->sum_brutto."</h4>"; ?><br>
        <?php echo "Dochód brutto: <h4>".($results['sumProceeds']->sum_brutto-$results['sumCosts']->sum_brutto)."</h4>"; ?><br>
        <br>
        <table class="form-table align">
            <thead>
            <th>Rok</th>
            <th>Miesiac</th>
            <th>Suma</th>
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
    </div>



    <?php //echo "<h4>Suma Netto wszystkich faktur: ".$results['monthlyBiling']->monthly."</h4>"; ?>
    <br>
    <?php  //include STATIC_COMPONENT.'\pages\components\statsList.php'; ?>
</div>








