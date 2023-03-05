<?php
defined('BASEPATH') or exit('No direct script access allowed');
/** set header **/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

require(APPPATH . 'libraries/RestController.php');
require(APPPATH . 'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Products extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('productsmodel'); //การเรียกช่ายโมดู
    }
    public function product_get()
    {
        $ProductID = $this->get('ProductID'); //เรียกแค่ 1 ชุด
        $productTypeID = $this->get('productTypeID'); //เรียกทั้งหมดที่เป็น ID เดียวกัน
        $brand = $this->get('brand');
        $status = $this->get("status");

        if ($productTypeID != "") {
            $where = "product.productTypeID = " . $productTypeID;
            $result = $this->productsmodel->getProductAll($where);
        } else if ($brand != "") {
            $where = "product.Brand = '" . $brand . "'";
            $result = $this->productsmodel->getProductAll($where);
        }else if($status == "all"){
            $result = $this->productsmodel->getProductAll("1=1");
        } else {
            $result = $this->productsmodel->getProductOne($ProductID);
        }

        $this->response($result, 200);
    }

    public function product_post() 
    {
        $Brand          = $this->post('Brand');
        $productTypeID  = $this->post('productTypeID');
        $ProductName    = $this->post('ProductName');
        $productDetail  = $this->post('productDetail');
        $Price          = $this->post('Price');
        $stock          = $this->post('stock');

        $id = "";
        $error = "";


        $filename = "";
        $error = "";
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        =  '*';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

        } else {
            $data = $this->upload->data();
            $filename = $data['file_name'];

            $data = array(
                "Brand"              => $Brand,
                "productTypeID"      => $productTypeID,
                "ProductName"        => $ProductName,
                "productDetail"      => $productDetail,
                "Price"              => $Price,
                "Picture"            => $filename,
                "stock"              => $stock
            );

            $id = $this->productsmodel->insertProduct($data);
        }
        if ($id != '') {
            $result = array(
                "status"    => "success",
                "detail"    => " Insert Product compleated"
            );
        } else {
            $result = array(
                "status"    => "error",
                "detail"    => "can not insert Product",
                "data"      => $error
            );
        }
        $this->response($result, 200);
    }

    

    public function product_put() //รับค่าเปง post
    {
        $Brand          = $this->put('Brand');
        $productTypeID  = $this->put('productTypeID');
        $ProductName    = $this->put('ProductName');
        $productDetail  = $this->put('productDetail');
        $Price          = $this->put('Price');
        $Picture        = $this->put('Picture');
        $stock          = $this->put('stock');
        $ProductID      = $this->put('ProductID');

        $data = array(
            "Brand"                 => $Brand,
            "productTypeID"         => $productTypeID,
            "ProductName"           => $ProductName,
            "productDetail"         => $productDetail,
            "Price"                 => $Price,
            "stock"                 => $stock,
            "Picture"               => $Picture
        );

        $where = "ProductID = $ProductID";

        $this->productsmodel->updateProduct($data, $where);


        $result = array(
            "status"    => "success",
            "detail"    => "update Product compleated"
        );
        $this->response($result, 200);
    }


    public function product_delete($ProductID)
    {
        $where = "ProductID = $ProductID";

        $this->productsmodel->deleteProduct($where);

        $result = array(
            "status"    => "success",
            "detail"    => "delete Product compleated"
        );


        $this->response($result, 200);
    }

    public function upload_post()
    {
        $filename = "";
        $error = "";
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*'; // 'gif|jpg|png|jpeg|doc|docx';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            //$this->load->view('upload_form', $error);
        } else {
            $data = $this->upload->data();
            $filename = $data['file_name'];
            //$this->load->view('upload_success', $data);
        }

        $result = array(
            "status"    => "success",
            "detail"    => "Upload compleated",
            "filename"   => $filename,
            "error"     => $error
        );

        return $this->response($result, 200);
    }
}
