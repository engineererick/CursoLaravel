<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Order;
use App\Image;

class Product extends Model {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'description', 'price', 'stock', 'status',
	];

	public function carts(){
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
	}
	
	public function orders(){
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
	}
	
	public function images(){
		return $this->morphMany(Image::class, 'imageable');
	}

	public function scopeAvailable($query){
		$query->where('status', 'available');
	}
}
