<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Membermodel extends CI_Model
{
    public function membersList()
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_members')
            ->get();
        return $q->result();
    }
    public function memberCard($id)
    {
        $q=$this->db->select('*')
                ->from('lm_tbl_members')
                ->where(['memberIdPK'=>$id])
                ->get();
        return $q->row();
    }
    public function addMember($array)
    {
        return $this->db->insert('lm_tbl_members', $array);
    }
    public function modifyMember($member, $array)
    {
        return $this->db->where('memberIdPK', $member)
            ->update('lm_tbl_members', $array);
    }
    public function fetchIssuedBooks($id)
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_books')
            ->join('lm_tbl_checkout', 'lm_tbl_checkout.bookId = lm_tbl_books.bookIdPK')
            ->where(['lm_tbl_checkout.returnDate'=>''])
            ->where(['lm_tbl_books.memberIdPK'=>$id])
            ->get();
        return $q->result();
    }
    public function instituteDetails($fields)
    {
        $q=$this->db->select($fields)
            ->from('lm_tbl_institution')
            ->where(['institutionIdPK'=>'1'])
            ->get();
        return $q->row();
    }
    public function modifyInstitute($institute, $array)
    {
        return $this->db->where('institutionIdPK', $institute)
            ->update('lm_tbl_institution', $array);
    }
    public function totalMembers()
    {
        $q=$this->db->select('COUNT(memberIdPK) AS members')
            ->from('lm_tbl_members')
            ->get();
        return $q->row();
    }
    public function fineDue($id)
    {
        if ($id!='*') {
            $q=$this->db->select('SUM(fine) AS dues')
                ->from('lm_tbl_checkout')
                ->where('isPaid', '0')
                ->where('memberId', $id)
                ->get();
            return $q->row();
        } else {
            $q=$this->db->select('SUM(fine) AS dues')
                ->where('isPaid', '0')
                ->from('lm_tbl_checkout')
                ->get();
            return $q->row();
        }
    }
    public function payDues($id)
    {
        $q=$this->db->select('checkOutIdPK, bookId, fine, isPaid')
            ->from('lm_tbl_checkout')
            ->where('isPaid', '0')
            ->where('fine >', '0')
            ->where('memberId', $id)
            ->get();
        $r=$q->result();
        $output='';
        if ($r) {
            foreach ($r as $row) {
                $output .='<tr>';
                $output .='<td><input type="hidden" name="booksId[]" value="'.$row->bookId.'">'.$row->bookId.'</td>';
                $output .='<td><input type="hidden" name="checkOutIdPK[]" value="'.$row->checkOutIdPK.'">'.$row->fine.'</td>';
                $output .='<td align="left"><input class="iput" type="checkbox" name="fine[]" value="'.$row->fine.'" /></td>';
                $output .='</tr>';
            }
            return $output;
        }
    }
    public function payFine($dues, $memID)
    {
        $count = count($dues['booksId']);
        $pType = 1;
        for ($i=0; $i<$count; $i++) {
            $bookId = $dues['booksId'][$i];
            $checkOutId = $dues['checkOutIdPK'][$i];
            $fine = $dues['fine'][$i];
            if (!empty($dues['fine'][$i])) {
                $data = array(
                    'memberId' => $memID,
                    'paymentType' => $pType,
                    'amount' => $fine,
                    'dateCreated' => Date('Y-m-d')
                );
                $q=$this->db->insert('lm_tbl_finance', $data);
                if ($q) {
                    $data2 = array(
                        'isPaid' => $fine
                    );
                    $this->db->where('checkOutIdPK', $checkOutId)
                        ->update('lm_tbl_checkout', $data2);
                }
            }
        }
    }
    public function payMonthlyFees($details, $memID)
    {
        $data = array(
            'memberId' => $memID,
            'paymentType' => '2',
            'amount' => $details['amount'],
            'dateCreated' => Date('Y-m-d')
        );
        $q=$this->db->insert('lm_tbl_finance', $data);
        if ($q) {
            $data2 = array(
                'initialDate' => Date('Y-m-d'),
                'expiry'=> Date('Y-m-d', strtotime("+".$details['months']." months"))
            );
            $this->db->where('memberIdPK', $memID)
                ->update('lm_tbl_members', $data2);
            return true;
        }
    }
    public function overDueBooks()
    {
        $q=$this->db->select('*')
            ->from('lm_tbl_checkout')
            ->join('lm_tbl_books', 'lm_tbl_books.bookIdPK = lm_tbl_checkout.bookId')
            ->join('lm_tbl_members', 'lm_tbl_members.memberIdPK = lm_tbl_checkout.memberId')
            ->where('lm_tbl_checkout.returnDate', '')
            ->where('lm_tbl_checkout.duedate <', date("Y-m-d"))
            ->get();
        return $q->result();
    }

}
