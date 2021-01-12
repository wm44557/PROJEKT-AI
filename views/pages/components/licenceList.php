<a class="toright" href="<?php echo STARTING_URL ?>">
    <button class="button secondary small">Wróć</button>
</a>
<div class="box">
    <h1>Moje licencje</h1>

    <form action="" method="GET">
        <div class="search-bar">
                <label>
                    Wyszukaj po:
                    <select class="form-input" name="searchSelect" onchange="changeSelector()">
                        <option value="sku">Numer inwentarzowy</option>
                        <option value="serial_number">Klucz seryjny</option>
                    </select>
                </label>
                <label>
                    Wyszukaj:
                    <input type="text" class="form-input" name="search" value="<?php echo $_GET['search'] ?? ''?>">
                </label>
            <input style="grid-column: span 2; justify-self: end;" class="button primary small" type="submit" value="Szukaj.." name="Result">
        </div>
    </form>


    <br>
    <div class="table-container">
        <table class="form-table spacing">
            <thead>
            <tr>
                <th>Numer inwentarzowy</th>
                <th>Klucz seryjny</th>
                <th>Nazwa</th>
                <th>Opis</th>
                <th>Ważne do</th>
                <th>Cena Netto</th>
                <th>Użytkownik</th>
                <th>Numer faktury</th>

            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($results['elements'] as $row) {
                echo '<tr>';
                echo '<td>' . $row->sku . '</td>';
                echo '<td>' . $row->serial_number . '</td>';
                echo '<td>' . $row->name . '</td>';
                echo '<td>' . $row->description . '</td>';
                echo '<td>' . $row->warranty_to . '</td>';
                echo '<td>' . $row->price_netto . '</td>';
                echo '<td>' . $row->who_uses . '</td>';
                echo '<td>' . $row->invoice_number . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

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
        "Numer inwentarzowy",
        "Klucz seryjny",
    ]

    const searchOptions = {
        "sku": 0,
        "serial_number": 1,
    }

    const selector = document.querySelector('select[name="searchSelect"]');
    const url_str = window.location;
    const url = new URL(url_str);

    const searchBy = url.searchParams.get("searchSelect");

    if (searchBy){
        selector.selectedIndex = searchOptions[searchBy];
    }

    function changeSelector(){
        const search = document.querySelector('input[name="search"]');
        search.placeholder = OPTIONS[selector.selectedIndex];
    }
    changeSelector();
</script>
