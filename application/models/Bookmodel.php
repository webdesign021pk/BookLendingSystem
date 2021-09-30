<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bookmodel extends CI_Model
{
    public function booksList()
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_books')
            ->join('lm_tbl_category', 'lm_tbl_category.subCatIdPK = lm_tbl_books.subCatId')
            ->join('lm_tbl_language', 'lm_tbl_language.languageIdPK = lm_tbl_books.languageId')
            ->get();
        return $q->result();
    }
    public function addBook($array)
    {
        return $this->db->insert('lm_tbl_books', $array);
    }
    public function bookCard($id)
    {
        $q=$this->db->select("*")
                ->from('lm_tbl_books')
                ->join('lm_tbl_category', 'lm_tbl_category.subCatIdPK = lm_tbl_books.subCatId')
                ->join('lm_tbl_language', 'lm_tbl_language.languageIdPK = lm_tbl_books.languageId')
                ->where(['bookIdPK'=>$id])
                ->get();
        return $q->row();
    }
    public function bookModify($book, $array)
    {
        return $this->db->where('bookIdPK', $book)
                        ->update('lm_tbl_books', $array);
    }
    public function bookCategory($field)
    {
        $q=$this->db->select($field)
                ->distinct()
                ->from('lm_tbl_category')
                ->get();
        return $q->result();
    }
    public function addCategory($array)
    {
        return $this->db->insert('lm_tbl_category', $array);
    }
    public function addLanguage($array)
    {
        return $this->db->insert('lm_tbl_language', $array);
    }
    public function modifyCategory($id, $field, $value)
    {
        // Update
        $data = array($field => $value);
        $this->db->where('subCatIdPK', $id);
        $this->db->update('lm_tbl_category', $data);
    }
    public function bookLanguage()
    {
        $q=$this->db->select('*')
            ->distinct()
            ->from('lm_tbl_language')
            ->get();
        //return $q->result();
        $r= $q->result_array();
        $languages = array_column($r, 'language', 'languageIdPK');
        $newArray = array_slice($languages, 0, 0, true) +
            array('' => 'Select') +
            array_slice($languages, 0, null, true);
        return $newArray;
    }
    public function languages()
    {
        $q=$this->db->select('*')
            ->distinct()
            ->from('lm_tbl_language')
            ->get();
        return $q->result();
    }
    public function modifyLanguage($id, $field, $value)
    {
        // Update
        $data = array($field => $value);
        $this->db->where('languageIdPK', $id);
        $this->db->update('lm_tbl_language', $data);
    }
    public function subCat($cat_id)
    {
        $this->db->where('category', $cat_id);
        $this->db->order_by('category', 'ASC');
        $query=$this->db->get('lm_tbl_category');
        $output='';
        foreach ($query->result() as $subCat) {
            $output.='<option value="'.$subCat->subCatIdPK.'">'.$subCat->subCat.'</option>';
        }
        return $output;
    }
    public function fetchBookCheckout($book, $duedays)
    {
        $expiry = Date('Y-m-d', strtotime("+".$duedays." days"));
        $q=$this->db->select('*')
                ->where('bookIdPK', $book)
                ->where('memberIdPK =', '0')
                ->from('lm_tbl_books')
                ->get();
        $output='';
        foreach ($q->result() as $article) {
            $output= "<tr><td><input type='hidden' name='booksId[]' value='".$article->bookIdPK."'>".$article->bookIdPK."</td>";
            $output.="<td>".$article->title."</td>";
            $output.="<td>".$article->author."</td>";
            $output.="<td><input type='hidden' name='expiry[]' value='".$expiry."'>".$expiry."</td>";
            $output.="<td><button class='delete btn btn-danger btn-sm' onclick='deleteRow(this)' name='delete'type='button'>DELETE</button></td></tr>";
        }
        return $output;
    }
    public function checkIn($book)
    {
        $q=$this->db->select('*')
            ->where('bookId', $book)
            ->where('returnDate =', '')
            ->from('lm_tbl_checkout')
            ->get();
        //print_r($q->row()) ;
        if ($q->row()!='') {
            foreach ($q->result() as $details) {
                $checkOutId = $details->checkOutIdPK;
                $dueDate = $details->dueDate;
                $today = date("Y-m-d");
                $date1 = date_create($today);
                $date2 = date_create($dueDate);
                $diff = date_diff($date2, $date1);
                $fine = $diff->format("%R%a");
                if ($fine<0) {
                    $fine = "0";
                }
            }
            $data = array(
                'returnDate' => $today,
                'fine' => $fine
            );
            $q2=$this->db->where('bookId', $book)
                        ->where('checkOutIdPK', $checkOutId)
                        ->update('lm_tbl_checkout', $data);
            if ($q2) {
                $data2 = array(
                    'memberIdPK' => '0'
                );
                $q3=$this->db->where('bookIdPK', $book)
                            ->update('lm_tbl_books', $data2);
            }
            //return true;
            $msg = "Book has been returned!!";
            return $msg;
        } else {
            $msg = "No book found or Book has been returned already!!";
            return $msg;
        }
    }
    public function checkOut($book)
    {
        $memID = $book['memberId'];
        $count = count($book['booksId']);
        for ($i=0; $i<$count; $i++) {
            $bookId = $book['booksId'][$i];
            $expiry = $book['expiry'][$i];
            $data = array(
                'memberId' => $memID,
                'bookId' => $bookId,
                'dueDate' => $expiry
            );
            $q=$this->db->insert('lm_tbl_checkout', $data);
            if ($q) {
                $data2 = array(
                    'memberIdPK' => $memID
                );
                $this->db->where('bookIdPK', $bookId)
                            ->update('lm_tbl_books', $data2);
            }
        }
    }
    public function totalIssued()
    {
        $q=$this->db->select('COUNT(memberIdPK) AS issued')
                    ->where('memberIdPK !=', '0')
                    ->from('lm_tbl_books')
                    ->get();
        return $q->row();
    }
    public function totalBooks()
    {
        $q=$this->db->select('COUNT(bookIdPK) AS books')
            ->from('lm_tbl_books')
            ->get();
        return $q->row();
    }
}
