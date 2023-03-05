<?php //ตัวอย่าง
    
     public function do_post() 
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        //$this->load->view('upload_success', $data);
                }

                $result = array(
                        "status"	=> "success",
                        "detail"	=> "Upload compleated"
                );

                return $this->response($result,200);
        }    


        /*public function address_post()//รับค่าเปง post
        {
            $address = $this->post('address');
            $postCode = $this->post('postCode');
            $memberID = $this->post('memberID');
    
            $data = array(
                        "address"		=> $address,
                        "postCode"		=> $postCode,
                        "memderID"		=> $memberID,
                );
    
           $id = $this->addressnmodel->insertAddress($data); 
            if($id != ''){
                        $result = array(
                                "status"	=> "success",
                                "detail"	=> "Address compleated"
                        );
                }else{
                        $result = array(
                                "status"	=> "error",
                                "detail"	=> "can not insert Address"
                        );
                }
            $this->response($result,200);
    
        }*/