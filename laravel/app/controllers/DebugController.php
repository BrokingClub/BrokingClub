<?php
/**
 * Project: BrokingClub | DebugController.php
 * Author: Simon - www.triggerdesign.de
 * Date: 10.05.2015
 * Time: 16:47
 */

class DebugController extends Controller{

    public function getPurchase(){
        $purchase = Purchase::find(23);

        var_dump($purchase);

    }
} 