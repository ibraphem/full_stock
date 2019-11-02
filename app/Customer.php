<?php namespace App;

use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use FileUploadTrait;
    const WALKING_CUSTOMER = "Walking Customer";

    protected $fillable = ['name', 'email', 'phone_number', 'prev_balance', 'payment'];

    public function customerPayments()
    {
        return $this->hasMany('App\CustomerPayment');
    }
    
    public function saveCustomer(Array $data)
    {
        $this->name = $data['name'];
        $this->email = (isset($data['email'])) ? $data['email'] : "";
        $this->phone_number = (isset($data['phone_number'])) ? $data['phone_number'] : "";
        $this->address = (isset($data['address'])) ? $data['address'] : "";
        $this->city = (isset($data['city'])) ? $data['city'] : "";
        $this->state = (isset($data['state'])) ? $data['state'] : "";
        $this->zip = (isset($data['zip'])) ? $data['zip'] : "";
        $this->company_name = (isset($data['company_name'])) ? $data['company_name'] : "";
        $this->account = (isset($data['account'])) ? $data['account'] : "";
        $this->prev_balance = (isset($data['prev_balance'])) ? $data['prev_balance'] : 0 ;
        $this->payment = (isset($data['payment'])) ? $data['payment'] : 0 ;
        $this->save();
    }

    public function saveCustomerAvatar($image)
    {
        $avatarName = $this->uploadImage($image, 'images/customers/');
        $this->avatar = $avatarName;
        $this->save();
    }

    public function updateCustomerBalance($customer_id, $dues)
    {
        $customer = Customer::findOrFail($customer_id);
        $customer->prev_balance = $customer->prev_balance + $dues;
        $customer->update();
    }
}
