<?php
	require("connection.php");

    $queryProcessor = mysqli_query($conn, "SELECT * from products where id_cate = 'CA004' and stok > 0 and status = 1");
    $queryMotherboard = mysqli_query($conn, "SELECT * from products where id_cate = 'CA005' and stok > 0 and status = 1");
    $queryRAM = mysqli_query($conn, "SELECT * from products where id_cate = 'CA006' and stok > 0 and status = 1");
    $queryVGA = mysqli_query($conn, "SELECT * from products where id_cate = 'CA003' and stok > 0 and status = 1");
    $querySSD = mysqli_query($conn, "SELECT * from products where id_cate = 'CA010' and stok > 0 and status = 1");
    $queryHDD = mysqli_query($conn, "SELECT * from products where id_cate = 'CA011' and stok > 0 and status = 1");
    $queryPSU = mysqli_query($conn, "SELECT * from products where id_cate = 'CA007' and stok > 0 and status = 1");
    $queryCasing = mysqli_query($conn, "SELECT * from products where id_cate = 'CA008' and stok > 0 and status = 1");

    $proc = $_REQUEST["proc"];
    $mobo = $_REQUEST["mobo"];
    $ram = $_REQUEST["ram"];
    $vga = $_REQUEST["vga"];
    $ssd = $_REQUEST["ssd"];
    $hdd = $_REQUEST["hdd"];
    $psu = $_REQUEST["psu"];
    $casing = $_REQUEST["casing"];

    $pr = $_REQUEST["pr"];
    $mo = $_REQUEST["mo"];
    $ra = $_REQUEST["ra"];
    $vg = $_REQUEST["vg"];
    $ss = $_REQUEST["ss"];
    $hd = $_REQUEST["hd"];
    $ps = $_REQUEST["ps"];
    $ca = $_REQUEST["ca"];

    $procQuery = mysqli_query($conn, "SELECT * from products where id_products = '$proc'");
    $dataProc = mysqli_fetch_array($procQuery);

    $moboQuery = mysqli_query($conn, "SELECT * from products where id_products = '$mobo'");
    $dataMobo = mysqli_fetch_array($moboQuery);

    $ramQuery = mysqli_query($conn, "SELECT * from products where id_products = '$ram'");
    $dataRam = mysqli_fetch_array($ramQuery);

    $vgaQuery = mysqli_query($conn, "SELECT * from products where id_products = '$vga'");
    $dataVga = mysqli_fetch_array($vgaQuery);

    $ssdQuery = mysqli_query($conn, "SELECT * from products where id_products = '$ssd'");
    $dataSsd = mysqli_fetch_array($ssdQuery);

    $hddQuery = mysqli_query($conn, "SELECT * from products where id_products = '$hdd'");
    $dataHdd = mysqli_fetch_array($hddQuery);

    $psuQuery = mysqli_query($conn, "SELECT * from products where id_products = '$psu'");
    $dataPsu = mysqli_fetch_array($psuQuery);

    $casingQuery = mysqli_query($conn, "SELECT * from products where id_products = '$casing'");
    $dataCasing = mysqli_fetch_array($casingQuery);

    $grandTotal = 0;
?>
    <div class="ml-10 mb-10 text-4xl font-bold">Build Your PC</div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">Processor</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_proc(this)" name="cbProc" class="w-[900px] border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($proc == "") echo "selected"; ?> value="">Choose the Processor</option>
                <?php
                    while($rowProcessor = mysqli_fetch_array($queryProcessor)){
                ?>
                <option <?php if ($proc == $rowProcessor["id_products"]) echo "selected"; ?> value="<?=$rowProcessor["id_products"]?>"><?=$rowProcessor["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_pr(this)" name="qtyProc" value="<?php if($proc == "") echo "0"; else echo $pr; ?>" min="<?php if($proc == "") echo "0"; else echo "1"; ?>" max="<?php if($proc == "") echo "0"; else echo $dataProc["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($proc == "") echo "0"; else {echo $pr*$dataProc["price"];$grandTotal += $pr*$dataProc["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">Motherboard</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_mobo(this)" name="cbMobo" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($mobo == "") echo "selected"; ?> value="">Choose the Motherboard</option>
                <?php
                    while($rowMotherBoard = mysqli_fetch_array($queryMotherboard)){
                ?>
                <option <?php if ($mobo == $rowMotherBoard["id_products"]) echo "selected"; ?> value="<?=$rowMotherBoard["id_products"]?>"><?=$rowMotherBoard["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_mo(this)" name="qtyMobo" value="<?php if($mobo == "") echo "0"; else echo $mo; ?>" min="<?php if($mobo == "") echo "0"; else echo "1"; ?>" max="<?php if($mobo == "") echo "0"; else echo $dataMobo["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($mobo == "") echo "0"; else {echo $mo*$dataMobo["price"];$grandTotal += $mo*$dataMobo["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">RAM</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_ram(this)" name="cbRam" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($ram == "") echo "selected"; ?> value="">Choose the RAM</option>
                <?php
                    while($rowRAM = mysqli_fetch_array($queryRAM)){
                ?>
                <option <?php if ($ram == $rowRAM["id_products"]) echo "selected"; ?> value="<?=$rowRAM["id_products"]?>"><?=$rowRAM["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_ra(this)" name="qtyRam" value="<?php if($ram == "") echo "0"; else echo $ra; ?>" min="<?php if($ram == "") echo "0"; else echo "1"; ?>" max="<?php if($ram == "") echo "0"; else echo $dataRam["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($ram == "") echo "0"; else {echo $ra*$dataRam["price"];$grandTotal += $ra*$dataRam["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">VGA</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_vga(this)" name="cbVga" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($vga == "") echo "selected"; ?> value="">Choose the VGA</option>
                <?php
                    while($rowVGA = mysqli_fetch_array($queryVGA)){
                ?>
                <option <?php if ($vga == $rowVGA["id_products"]) echo "selected"; ?> value="<?=$rowVGA["id_products"]?>"><?=$rowVGA["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_vg(this)" name="qtyVga" value="<?php if($vga == "") echo "0"; else echo $vg; ?>" min="<?php if($vga == "") echo "0"; else echo "1"; ?>" max="<?php if($vga == "") echo "0"; else echo $dataVga["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($vga == "") echo "0"; else {echo $vg*$dataVga["price"];$grandTotal += $vg*$dataVga["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">SSD</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_ssd(this)" name="cbSsd" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($ssd == "") echo "selected"; ?> value="">Choose the SSD</option>
                <?php
                    while($rowSSD = mysqli_fetch_array($querySSD)){
                ?>
                <option <?php if ($ssd == $rowSSD["id_products"]) echo "selected"; ?> value="<?=$rowSSD["id_products"]?>"><?=$rowSSD["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_ss(this)" name="qtySsd" value="<?php if($ssd == "") echo "0"; else echo $ss; ?>" min="<?php if($ssd == "") echo "0"; else echo "1"; ?>" max="<?php if($ssd == "") echo "0"; else echo $dataSsd["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($ssd == "") echo "0"; else {echo $ss*$dataSsd["price"];$grandTotal += $ss*$dataSsd["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">HDD</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_hdd(this)" name="cbHdd" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($hdd == "") echo "selected"; ?> value="">Choose the HDD</option>
                <?php
                    while($rowHDD = mysqli_fetch_array($queryHDD)){
                ?>
                <option <?php if ($hdd == $rowHDD["id_products"]) echo "selected"; ?> value="<?=$rowHDD["id_products"]?>"><?=$rowHDD["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_hd(this)" name="qtyHdd" value="<?php if($hdd == "") echo "0"; else echo $hd; ?>" min="<?php if($hdd == "") echo "0"; else echo "1"; ?>" max="<?php if($hdd == "") echo "0"; else echo $dataHdd["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($hdd == "") echo "0"; else {echo $hd*$dataHdd["price"];$grandTotal += $hd*$dataHdd["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">PSU</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_psu(this)" name="cbPsu" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($psu == "") echo "selected"; ?> value="">Choose the PSU</option>
                <?php
                    while($rowPSU = mysqli_fetch_array($queryPSU)){
                ?>
                <option <?php if ($psu == $rowPSU["id_products"]) echo "selected"; ?> value="<?=$rowPSU["id_products"]?>"><?=$rowPSU["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_ps(this)" name="qtyPsu" value="<?php if($psu == "") echo "0"; else echo $ps; ?>" min="<?php if($psu == "") echo "0"; else echo "1"; ?>" max="<?php if($psu == "") echo "0"; else echo $dataPsu["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($psu == "") echo "0"; else {echo $ps*$dataPsu["price"];$grandTotal += $ps*$dataPsu["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="my-4 flex gap-2">
        <div class="min-w-[80px]">Casing</div>
        <div class="flex justify-end ml-20 w-2/3">
            <select onchange="change_casing(this)" name="cbCasing" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                <option <?php if ($casing == "") echo "selected"; ?> value="">Choose the Casing</option>
                <?php
                    while($rowCasing = mysqli_fetch_array($queryCasing)){
                ?>
                <option <?php if ($casing == $rowCasing["id_products"]) echo "selected"; ?> value="<?=$rowCasing["id_products"]?>"><?=$rowCasing["nama"]?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <input type="number" onchange="amount_ca(this)" name="qtyCasing" value="<?php if($casing == "") echo "0"; else echo $ca; ?>" min="<?php if($casing == "") echo "0"; else echo "1"; ?>" max="<?php if($casing == "") echo "0"; else echo $dataCasing["stok"]; ?>" class="border border-slate-400 rounded-lg">
        <div class="flex">
            Rp: <input type="text" value="<?php if ($casing == "") echo "0"; else {echo $ca*$dataCasing["price"];$grandTotal += $ca*$dataCasing["price"];}?>" class="border border-slate-400 rounded-lg" disabled>
        </div>
    </div>
    <div class="ml-auto flex">
        <div class="text-2xl font-semibold">Grand Total : Rp</div>
        <input type="text" value="<?=number_format($grandTotal)?>" class="rounded-lg border border-slate-400" disabled>
    </div>
    <div class="ml-auto flex gap-2">
        <button type="submit" formaction="#" class="px-5 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Reset</button>
        <button type="submit" name="addToCart" class="px-5 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Add to Cart</button>
    </div>
</html>