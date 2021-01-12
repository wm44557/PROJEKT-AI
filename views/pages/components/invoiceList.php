
<a class="toright" href="<?php echo STARTING_URL ?>">
    <button class="button secondary small">Wróć</button>
</a>
<div class="box">
    <h1> Lista Faktur</h1>
    <form action="" method="GET">
        <div class="search-bar">
            <label>
                Wyszukaj po:
                <select class="form-input" name="searchSelect" onchange="changeSelector()">
                    <option value="id">Identyfikatorze własnym</option>
                    <option value="invoice_number">Numerze faktury</option>
                    <option value="vat_id">VAT ID kontrahenta</option>
                    <option value="name">Nazwie kontrahenta</option>
                </select>
            </label>
            <label>
                Wyszukaj:
                <input type="text" class="form-input" name="search" value="<?php echo $_GET['search'] ?? ''?>"/>
            </label>
            <div>
                Przedział czasowy:
                <div class="flex">
                    <input class="form-input" type="date" name="since_date" value="<?php echo $_GET['since_date'] ?>"/>
                    <input class="form-input" type="date" name="to_date" value="<?php echo $_GET['to_date'] ?>"/>
                </div>
            </div>

            <div>
                <label>
                    Rodzaj faktury:
                    <select class="form-input" name="MyRadio">
                        <option value="First">Kupna</option>
                        <option value="Second">Sprzedaży</option>
                    </select>
                </label>
            </div>
            <input style="grid-column: span 2; justify-self: end;" class="button primary small" type="submit" value="Szukaj.." name="Result">
        </div>
    </form>

    <br>
    <table class="form-table spacing">
        <thead>
        <tr>
            <th>Numer faktury</th>
            <th>Kontrahent</th>
            <th>NIP</th>
            <th>Data wystawienia faktury</th>
            <th>Cena Brutto</th>
            <th>Szczegóły</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //dump($results);
        foreach ($results['elements'] as $row) {
            echo '<tr>';
            echo '<td>' . $row->invoice_number . '</td>';
            echo '<td>' . $row->name . '</td>';
            echo '<td>' . $row->vat_id . '</td>';
            echo '<td>' . $row->date_of_invoice . '</td>';
            echo '<td>' . $row->sum_brutto . '</td>';
            echo '<td><a href="'. STARTING_URL . '/' . $_SESSION['user_role'] . '/show-invoice?invoiceId=' . $row->ID . '"' . '>
            <button class="button primary small">Więcej</button>
        </a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <br>
    <div class="pagination-box">
        <h4>Paginacja</h4>
        <div class="pages">
            <?php
            if($_GET) {
                $search = $_GET['search'] ?? "";
                $searchSelect = $_GET['searchSelect'] ?? "";
                $since=$_GET['since_date'] ?? "";
                $to=$_GET['to_date'] ?? "";
            }


            for ($i = 1; $i <= $results['paginationInfo']; $i++) {
                $page = 1;
                $class = "";
                if (isset($_GET['page'])){
                    if ((int)$_GET['page']==$i){
                        $class = "class='bold'";
                    }
                } else{
                    if ($i == 1){
                        $class = "class='bold'";
                    }
                }
                echo " <a " . $class . "href='?page=" . $i . "&searchSelect=".$searchSelect. "&search=".$search."&since_date=".$since."&to_date=".$to."'>" . $i . "</a>";
            }
            ?>
        </div>
    </div>

</div>




<script>
    const OPTIONS = [
        "Identyfikator własny",
        "Numer faktury",
        "Vat ID kontrahenta",
        "Nazwa kontrahenta",
    ]

    const searchOptions = {
        "id": 0,
        "invoice_number": 1,
        "vat_id": 2,
        "name": 3,
    }

    const radioOptions = {
        "First": 0,
        "Second": 1,
    }


    const selector = document.querySelector('select[name="searchSelect"]');
    const selectorRadio = document.querySelector('select[name="MyRadio"]');

    const url_str = window.location;
    const url = new URL(url_str);

    const searchBy = url.searchParams.get("searchSelect");
    const radio = url.searchParams.get("MyRadio");

    if (searchBy){
        selector.selectedIndex = searchOptions[searchBy];
    }
    if (radio){
        selectorRadio.selectedIndex = radioOptions[radio];
    }

    function changeSelector(){
        const search = document.querySelector('input[name="search"]');
        search.placeholder = OPTIONS[selector.selectedIndex];
    }
    changeSelector();
</script>