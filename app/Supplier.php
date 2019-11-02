<?php namespace App;

use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use FileUploadTrait;

    protected $fillable = ['company_name', 'name', 'email', 'phone_number','address', 'city', 'state', 'zip', 'comments', 'account', 'prev_balance', 'payment'];

    public function saveSupplierAvatar($image)
    {
        $avatarName = $this->uploadImage($image, 'images/suppliers/');
        $this->avatar = $avatarName;
        $this->save();
    }

    public function saveSupplier(Array $data)
    {
        $this->company_name = $data['company_name'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone_number = $data['phone_number'];
        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->zip = $data['zip'];
        $this->account = $data['comments'];
        $this->account = $data['account'];
        $this->prev_balance = $data['prev_balance'];
        $this->payment = $data['payment'];
        $this->save();
    }
}
