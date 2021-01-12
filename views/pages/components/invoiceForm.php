

<a style="text-align: right" href="<?php echo STARTING_URL . '/' . $_SESSION['user_role']?>"><button class="button secondary small">Wróć</button></a>
<br><br>
<form class="form-box" method="post">
    <div class="form-info">
        <h2>Dane podstawowe:</h2>
        <p>Podstawowe dane dotyczące faktury.</p>
    </div>

    <div class="form-fields">

        <label class="form-input-label text">
            Numer faktury
            <input type="text" name="invoiceNumber" placeholder="Wprowadź numer faktury">
        </label>

        <label class="form-input-label text">
            Nazwa kontrahenta
            <input type="text" name="contractor" placeholder="Wprowadź nazwę kontrahenta">
        </label>

        <label class="form-input-label text">
            Vat ID kontrahenta
            <input type="text" name="contractorVatId" placeholder="Wprowadź vat id kontrahenta">
        </label>

        <label class="form-input-label text">
            Data wystawienia faktury
            <input type="date" name="dateInvoice" placeholder="Podaj datę wystawienia faktury">
        </label>

        <label class="form-input-label text">
            Typ faktury
            <select name="type">
                <option value="sale">Sprzedaży</option>
                <option value="buy">Kupna</option>
            </select>
        </label>
    </div>

    <div class="form-table-container">
        <h2>Licencje</h2>
        <p>Wprowadź licencje przypisane do podanej faktury</p>
        <br>
        <div class="table-container">
            <table class="form-table licences">
                <thead>
                <tr>
                    <th></th>
                    <th>SKU</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th>Numer seryjny</th>
                    <th>Data zakupu</th>
                    <th>Gwarancja do</th>
                    <th>Ważna do</th>
                    <th>Cena netto</th>
                    <th>Vat</th>
                    <th>Cena brutto</th>
                    <th>Kto używa</th>
                </tr>
                </thead>
                <tbody>
                <tr id="licence-1" data-order="1">
                    <td>
                        <input type="checkbox" class="licence-checkbox" name="licenceDelete-1" id="licenceDelete-1">
                    </td>
                    <td>
                        <input type="text" name="licenceSku-1" id="licenceSku-1">
                    </td>
                    <td>
                        <input type="text" name="licenceName-1" id="licenceName-1">
                    </td>
                    <td>
                        <input type="text" name="licenceDescription-1" id="licenceDescription-1">
                    </td>
                    <td>
                        <input type="text" name="licenceSerial-1" id="licenceSerial-1">
                    </td>
                    <td>
                        <input type="date" name="licenceBuyDate-1" id="licenceBuyDate-1">
                    </td>
                    <td>
                        <input type="date" name="licenceWarrantyDate-1" id="licenceWarrantyDate-1">
                    </td>
                    <td>
                        <input type="date" name="licenceValidTo-1" id="licenceValidTo-1">
                    </td>
                    <td>
                        <input type="number" name="licenceNetto-1" id="licenceNetto-1">
                    </td>
                    <td>
                        <input type="number" name="licenceVat-1" id="licenceVat-1" min="0" max="100">
                    </td>
                    <td>
                        <input type="number" name="licenceBrutto-1" id="licenceBrutto-1">
                    </td>
                    <td>
                        <input type="text" name="licenceWhoUses-1" id="licenceWhoUses-1">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="buttons-group">
            <p class="button warning small" onclick="deleteInvoiceTableFields();"><i class="material-icons">remove</i>Usuń</p>
            <p class="button primary small" onclick="addNewInvoiceTableField();"><i class="material-icons">add</i>Dodaj</p>
        </div>
        <input type="hidden" name="licencesCount" id="licencesCount" value="1">
    </div>

    <div class="form-info">
        <h2>Podsumowanie</h2>
        <p>Informacje podsumowujące całą fakturę.</p>
    </div>

    <div class="form-fields">

        <label class="form-input-label text">
            Wartość netto
            <input type="number" name="sumNetto" placeholder="Wprowadź wartość netto">
        </label>

        <label class="form-input-label text">
            Vat
            <input type="number" name="sumVAT" placeholder="Wprowadź VAT">
        </label>

        <label class="form-input-label text">
            Wartość brutto
            <input type="number" name="sumBrutto" placeholder="Wprowadź wartość brutto">
        </label>
    </div>
    <input style="grid-column: span 2; justify-self: center; margin-top: 2rem;" class="button primary big" type="submit" value="Wyślij"><br>
</form>
<br>


<script>
    const INPUTS = [
        {
            type: "checkbox",
            class: "licence-checkbox",
            name: "licenceDelete",
        },
        {
            type: "text",
            class: "",
            name: "licenceSku",
        },
        {
            type: "text",
            class: "",
            name: "licenceName",
        },
        {
            type: "text",
            class: "",
            name: "licenceDescription",
        },
        {
            type: "text",
            class: "",
            name: "licenceSerial",
        },
        {
            type: "date",
            class: "",
            name: "licenceBuyDate",
        },{
            type: "date",
            class: "",
            name: "licenceWarrantyDate",
        },{
            type: "date",
            class: "",
            name: "licenceValidTo",
        },
        {
            type: "number",
            class: "",
            name: "licenceNetto",
        },
        {
            type: "number",
            class: "",
            name: "licenceVat",
            additional: {"min": 0, "max": 100}
        },
        {
            type: "number",
            class: "",
            name: "licenceBrutto",
        },
        {
            type: "text",
            class: "",
            name: "licenceWhoUses",
        },
    ];

    function addNewInvoiceTableField(){
        const countElement = document.querySelector('#licencesCount');
        const count = parseInt(countElement.value) + 1;
        countElement.value = count;

        const tableBody = document.querySelector('table.form-table.licences tbody');

        const rowEl = document.createElement('tr');
        rowEl.id = `licence-${count}`;

        INPUTS.forEach( input => {
            const tdEl = document.createElement('td');
            const inputEl = document.createElement('input');
            inputEl.type = input.type;
            inputEl.name = `${input.name}-${count}`;
            if (input.class){
                inputEl.classList.add(input.class);
            }
            if (typeof input.additional !== "undefined"){
                Object.entries(input.additional).forEach( entry => {
                    const [key, value] = entry;
                    if (key==="min"){
                        inputEl.min = value;
                    } else if(key==="max"){
                        inputEl.max = value;
                    }
                })
            }
            tdEl.appendChild(inputEl);
            rowEl.appendChild(tdEl);

        });
        tableBody.appendChild(rowEl);

    }

    function deleteInvoiceTableFields(){
        const checkboxes = document.querySelectorAll('.licence-checkbox');

        const checkedCheckboxes = [...checkboxes].filter( checkbox => checkbox.checked );

        checkedCheckboxes.map( checkbox => {
            checkbox.parentElement.parentElement.remove();
        })
    }

</script>