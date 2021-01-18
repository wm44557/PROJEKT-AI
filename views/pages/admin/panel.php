<?php if (isset($_SESSION['alert'])): ?>
    <div class="alertbox"><p><?php echo $_SESSION['alert']?></p><i class="material-icons">close</i></div>
    <?php unset($_SESSION['alert']); ?>
<?php endif ?>
<div class="box">
    <h1>Panel Administratora</h1>
    <div class="boxAdmin">
        <a href="<?php echo STARTING_URL ?>/admin/register"><button class="button primary">Zarejestruj użytkownika</button></a>
        <a href="<?php echo STARTING_URL ?>/admin/users-list"><button class="button primary">Lista użytkowników</button></a>
    </div>

    <h1>
        Statystki
    </h1>
    <br>
    <div class="stats-grid">
        <?php echo "<div class='stat'>Ilość faktur w systemie: <h4>" . $results['countRecords']->countRecords . "</h4></div>"; ?>
        <?php echo "<div class='stat'>Przychód brutto: <h4>" . $results['sumProceeds']->sum_brutto . "</h4></div>"; ?>
        <?php echo "<div class='stat'>Koszty brutto: <h4>" . $results['sumCosts']->sum_brutto . "</h4></div>"; ?>
        <?php echo "<div class='stat'>Dochód brutto: <h4>" . ($results['sumProceeds']->sum_brutto - $results['sumCosts']->sum_brutto) . "</h4></div>"; ?>
    </div>
    <div class="stats-box">
        <h2>Podsumowanie według danego roku</h2><br>
        <table class="form-table align">
            <thead>
                <th>Rok</th>
                <th>Miesiac</th>
                <th>Suma</th>
            </thead>
            <tbody>
                <?php foreach ($results['monthlyBiling']['sale'] as $result) {
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



    <?php //echo "<h4>Suma Netto wszystkich faktur: ".$results['monthlyBiling']->monthly."</h4>"; 
    ?>
    <br>
    <?php  //include STATIC_COMPONENT.'\pages\components\statsList.php'; 
    ?>
</div>

<script>
    const stats = document.querySelectorAll('.stats-grid .stat h4');
    let countdown;


    stats.forEach(stat => {
        let value = parseInt(stat.innerHTML);
        stat.innerHTML = "";
        value = value / 10;
        let newValue = 0;

        let i = 0;
        const counter = setInterval(() => {
            i++;
            newValue += value;
            stat.innerHTML = parseInt(newValue);
            if (i === 10) {
                clearInterval(counter)
            }
        }, 70)
    })

    const alert = document.querySelector('.alertbox');
    const closeAlert = document.querySelector('.alertbox i')

    if (alert){
        closeAlert.addEventListener('click', () => {
            alert.remove();
        })
        setTimeout( () => {
            alert.remove();
        }, 5000)
    }
</script>