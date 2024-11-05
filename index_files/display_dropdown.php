<form method="POST" action="index.php">
    <div class="form-group">
        <label for="tableSelect">Choose a table:</label>
        <select name="tableName" id="tableSelect" class="form-control" required>
            <option value="" selected disabled>Select a Table</option>
            <option value="foodtype">Food Type</option>
            <option value="foodvehicle">Food Vehicle</option>
            <option value="import_amount_oilseeds">Import Amount Oilseeds</option>
            <option value="import_edible_oil">Import Edible Oil</option>
            <option value="local_production_amount_oilseed">Local Production Amount (Oilseed)</option>
            
            <option value="producers_supply">Producers Supply Amount</option>
            <option value="producers_brand_name">Producer Brands</option>
            <option value="producer_skus">Producer SKUs</option>
            
            <option value="raw_crops">Raw Crops</option>
            <option value="producers_brand_name">Producers Brands Name</option>
            <option value="total_supply_amount_edible_oil">Total Supply Amount (Edible Oil)</option>
            
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Show Table</button>
</form>

