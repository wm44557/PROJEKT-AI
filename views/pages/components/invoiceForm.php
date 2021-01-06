

<a  href="<?php echo STARTING_URL . $_SESSION['user_role']?>"><button class="button primary small">Wróc</button></a>
<br><br>
<form class="box" method="post">
    <h2>Data:</h2>

    <input type="text" name="invoiceNumber" placeholder="Invoice number.."><br><br>
    <input type="text" name="contractor" placeholder="Contractor name.."><br><br>
    <input type="text" name="contractorVatId" placeholder="Contractor vat ID.."><br><br>

    <input type="date" name="dateInvoice" placeholder="Date invoice.."><br><br>
    <input type="text" name="type" placeholder="Type.."><br><br>

    <br>
    <h2>Licence:</h2>

    <input type="text" name="sku" placeholder="Sku.." size="10">&nbsp;
    <input type="text" name="name" placeholder="Name licence..">&nbsp;
    <input type="text" name="description" placeholder="Description..">&nbsp;
    <input type="text" name="serialNumber" placeholder="serialNumber..">&nbsp;
    <input type="date" name="buyDate" placeholder="Date of purchase..">&nbsp;
    <input type="date" name="warranty" placeholder="Warranty to..">&nbsp;
    <input type="date" name="valid" placeholder="Valid to..">&nbsp;<br>
    <input type="text" name="owner" placeholder="Owner..">
    <input type="number" name="priceNetto" placeholder="Price (netto)..">&nbsp;
    <input type="number" name="vat" placeholder="Amount VAT..">&nbsp;
    <input type="number" name="priceBrutto" placeholder="Price (brutto)..">&nbsp;

    <br><br>


    <h2>Summary</h2>
    <input type="number" name="sumNetto" placeholdgit er="Netto SUM..">&nbsp;
    <input type="number" name="sumVAT" placeholder="Vat SUM..">&nbsp;
    <input type="number" name="sumBrutto" placeholder="Brutto SUM..">
    <br>
    <br>
    <br>
    <input class="button secondary small" type="submit" value="Wyślij"><br>
</form>
<br>
