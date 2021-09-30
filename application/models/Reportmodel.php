<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportmodel extends CI_Model
{
    public function printCatalogue($cat)
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_books')
            ->join('lm_tbl_category', 'lm_tbl_category.subCatIdPK = lm_tbl_books.subCatId')
            ->join('lm_tbl_language', 'lm_tbl_language.languageIdPK = lm_tbl_books.languageId')
            ->where('lm_tbl_category.category', $cat)
            ->get();
        $r=$q->result();
        $output = '';
        $output .= '<div class="h5 mt-2">';
        $output .= '<div><span>Books Catalogue</span><button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();">Print</button></div>';
        $output .= '<h5>Category: <span class="text-info">'.$cat.'</span></h5>';
        $output .= '</div>';
        $output .= '<table class="table bordered" style="max-width: 260mm">';
        $output .= '<thead class="font-weight-bold">';
        $output .= '<tr>';
        $output .= '<td>ID</td>';
        $output .= '<td>Title</td>';
        $output .= '<td>Author</td>';
        $output .= '<td>Language</td>';
        $output .= '<td>Sub Category</td>';
        $output .= '<td>Publication</td>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        if ($r) {
            foreach ($r as $row) {
                $output .= '<tr>';
                $output .= '<td>';
                $output .= $row->bookIdPK;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->title;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->author;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->language;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->subCat;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->publisher;
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr>';
            $output .= '<td colspan="6">No Book found in this Category</td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
        return $output;
    }
    public function printMembers($status)
    {
        $today = date("Y-m-d");
        if ($status=='Expired') {
            $q=$this->db->select('*')
                ->from('lm_tbl_members')
                ->where('expiry <', $today)
                ->get();
        } elseif ($status=='Inactive/Deleted') {
            $q=$this->db->select('*')
                ->from('lm_tbl_members')
                ->where('memberStatus =', '0')
                ->get();
        } elseif ($status=='Active') {
            $q=$this->db->select('*')
                ->from('lm_tbl_members')
                ->where('expiry >', $today)
                ->where('memberStatus =', '1')
                ->get();
        } elseif ($status=='Free') {
            $q=$this->db->select('*')
                ->from('lm_tbl_members')
                ->where('expiry >', $today)
                ->where('memberStatus =', '2')
                ->get();
        } else {
            $q=$this->db->select('*')
                ->from('lm_tbl_members')
                ->get();
        }
        //return $q->result();
        $r=$q->result();
        $output = '';
        $output .= '<div class="h5 mt-2">';
        $output .= '<div><span>Members List</span><button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();">Print</button></div>';
        $output .= '<h5>Category: <span class="text-info">'.$status.'</span></h5>';
        $output .= '</div>';
        $output .= '<table class="table bordered" style="max-width: 260mm">';
        $output .= '<thead class="font-weight-bold">';
        $output .= '<tr>';
        $output .= '<td>ID</td>';
        $output .= '<td>Full Name</td>';
        $output .= '<td>Contact</td>';
        $output .= '<td>Address</td>';
        $output .= '<td>Gender</td>';
        $output .= '<td>Expiry</td>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        if ($r) {
            foreach ($r as $row) {
                if(($row->gender)=='2'){$gender='Female';} else {$gender='Male';}
                $output .= '<tr>';
                $output .= '<td>';
                $output .= $row->memberIdPK;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->fullName;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->contact;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->address;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $gender;
                $output .= '</td>';
                $output .= '<td>';
                $output .= $row->expiry;
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr>';
            $output .= '<td colspan="6">No Member found in this Category</td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
        return $output;
    }
    public function printIdCards($id, $institute)
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_members')
            ->where('memberIdPK', $id)
            ->get();
        $r=$q->row();
        $output = '';
        if ($r) {
            $output .='<button class="float-right btn btn-sm btn-primary" id="printPageButton" onclick="print();">Print</button>';
            $output .= '<div class="row m-2 border" style="max-width: 3.370in; max-height: 2.125in;">';
            $output .= '<table border="1" width="100%">';
            $output .= '<thead class="text-center">';
            $output .= '<tr>';
            $output .= '<th colspan="2" class="bg-secondary text-white">';
            $output .= $institute->name;
            $output .= '</th>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<th colspan="2">Membership Card</th>';
            $output .= '</tr>';
            $output .= '</thead>';
            $output .= '<tr>';
            $output .= '<td rowspan="4">';
            $output .= '<img src="'.base_url($r->image_path).'" class="float-left" style="max-width: 1in; ">';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= 'Full Name:<span class="float-right font-weight-bold">ID:'.$r->memberIdPK.'</span><br/><span class="font-weight-bold">'.$r->fullName
                .'</span><br />';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= 'Contact No. <span class="float-right font-weight-bold">'.$r->contact.'</span><br/>';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<td>';
            $output .= 'Expiry Date: <span class="float-right font-weight-bold">'.$r->expiry.'</span><br/>';
            $output .= '</td>';
            $output .= '</tr>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '';
        } else {
            $output .= 'No Member Found';
        }
        return $output;
    }
    public function printStatement($id, $type, $member)
    {
        $paymentType='Monthly Fees';
        if($type==1){$paymentType='Fine/Dues';};
        $q=$this->db->select('*')
            ->from('lm_tbl_finance')
            ->where('memberId', $id)
            ->where('paymentType', $type)
            ->get();
        $r=$q->result();
        $output = '';
        $total=0;
        if ($r) {
            $output .= '<div class="h5 mt-2">';
            $output .= '<div><span>Member Finance Statement</span><button class="float-right btn btn-sm btn-primary" id="printPageButton"
            onclick="print();">Print</button></div>';
            $output .= '<h5>of: <span class="text-info">'.$paymentType.'</span></h5>';
            $output .= '</div>';
            $output .= '<table class="table bordered" style="max-width: 260mm">';
            $output .= '<thead class="font-weight-bold">';
            $output .= '<tr>';
            $output .= '<th>Member ID:</th>';
            $output .= '<td colspan="2"><span class="text-right">'.$member->memberIdPK.'</span></td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<th>Full Name:</th>';
            $output .= '<td colspan="2"><span class="text-right">'.$member->fullName.'</span></td>';
            $output .= '</tr>';
            $output .= '<tr>';
            $output .= '<th>Contact:</th>';
            $output .= '<td colspan="2"><span class="text-right">'.$member->contact.'</span></td>';
            $output .= '</tr>';
            $output .= '</thead>';
            $output .= '<tbody>';
            $output .= '<tr class="bg-light">';
            $output .= '<td colspan="3">Payment Details</td>';
            $output .= '</tr>';
            $output .= '<tr class="font-weight-bold">';
            $output .= '<td>Date</td>';
            $output .= '<td>Transaction ID</td>';
            $output .= '<td>Amount</td>';
            $output .= '</tr>';
            foreach ($r as $row) {
                $total=$total+$row->amount;
                $output .= '<tr>';
                $output .= '<td>'.$row->dateCreated.'</td>';
                $output .= '<td>'.$row->financeIdPK.'</td>';
                $output .= '<td>'.$row->amount.'</td>';
                $output .= '</tr>';
            }
            $output .= '</tbody>';
            $output .= '<tfoot class="font-weight-bold">';
            $output .= '<tr>';
            $output .= '<td colspan="2" align="right">Total Amount:</td>';
            $output .= '<td>'.$total.'</td>';
            $output .= '</tr>';
            $output .= '</tfoot>';
            $output .= '</table>';
            $output .= '</div>';
            $output .= '';
        } else {
            $output .= 'No Transactions Found';
        }
        return $output;
    }
}