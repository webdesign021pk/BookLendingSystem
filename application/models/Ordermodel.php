<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ordermodel extends CI_Model
{
    function storeName($id)
    {
        $q=$this->db->select('om_tbl_store.storeName')
            ->from('om_tbl_store')
            ->where('om_tbl_store.storeIdPK', $id)
            ->get();
        return $q->row()->storeName;
    }
    public function products($id)
    {
        $q=$this->db->select('*')
            ->from('om_tbl_products')
            ->where('om_tbl_products.storeId', $id)
            ->where('om_tbl_products.status', 1)
            ->get();
        return $q->result();
    }
    public function productList($id)
    {
        $q=$this->db->select('om_tbl_products.productIdPK,om_tbl_products.articleName,om_tbl_products.articleNo,om_tbl_products.sellPrice,om_tbl_products.image_path,users.sellerName')
            ->from('om_tbl_products')
            ->join('users','users.userIdPK=om_tbl_products.sellerId')
            ->where('om_tbl_products.status',1)
            ->get();
        return $q->result();
    }
    function productCard($id)
    {
        $q=$this->db->select('om_tbl_products.*')
            ->from('om_tbl_products')
            ->where('om_tbl_products.productIdPK',$id)
            ->get();
        return $q->row();
    }

    public function addProduct($array)
    {
        return $this->db->insert('om_tbl_products', $array);
    }
    public function modifyProduct($article, $array)
    {
        return $this->db->where('productIdPK', $article)
            ->update('om_tbl_products', $array);
    }
    public function newOrder($array)
    {
        $this->db->insert('om_tbl_orders', $array);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    function viewOrder($id)
    {
        $q=$this->db->select('om_tbl_orders.*,om_tbl_products.*,om_tbl_orderproducts.*')
            ->from('om_tbl_orderproducts')
            ->join('om_tbl_orders','om_tbl_orders.orderIdPK=om_tbl_orderproducts.orderId')
            ->join('om_tbl_products','om_tbl_products.productIdPK=om_tbl_orderproducts.productId')
            ->where('om_tbl_orderproducts.orderId',$id)
            ->get();
        return $q->result();
    }
    function orderPending()
    {
        $q=$this->db->select('*')
            ->from('om_tbl_orders')
            ->where('om_tbl_orders.storeId',$_SESSION['storeId'])
            ->where('om_tbl_orders.orderStatus != 3')
            ->get();
        return $q->result();
    }

}
