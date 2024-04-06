<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Producttype;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use App\Models\Cart;

class ProductController extends Controller
{
   public function products_celebrity()
   {
      $product    =  Product::get();
      $data       =  compact('product');

      return view('product.celebrity')->with($data);
   }

   public function products_newarrival()
   {
      $product    =  Product::get();
      $data       =  compact('product');

      return view('product.newarrival')->with($data);
   }

   public function products_festival()
   {
      $product    =  Product::get();
      $data       =  compact('product');

      return view('product.festival')->with($data);
   }

   public function products_deal()
   {
      $product    =  Product::get();
      $data       =  compact('product');

      return view('product.deal')->with($data);
   }

   public function products_search()
   {
      $product =  Product::get();
      $data    =  compact('product');

      return view('product.search')->with($data);
   }

   public function products_ptype($slug)
   {
      $ptype         =  Producttype::where('slug',$slug)->first();
      if($ptype)
      {
         $ptypeid    =  $ptype['id'];
      
         $product    =  Product::where('producttype_id',$ptypeid)->get();
         $data       =  compact('ptype','product');
   
         return view('product.ptype')->with($data);
      }
      else
      {
         return view('no_found');
      }
   }

   public function product_detail($slug)
   {
      $pdetail       =     Product::where('slug',$slug)->first();
      $similar       =     Product::paginate('12');
      
      $attribute     =     ProductAttribute::where('product_id',$pdetail['id'])->get();
      if($attribute)
      {
         $productAttribute = '';
         
         foreach($attribute as $attributes)
         {                                    
            $productAttribute.="<li>".$attributes->attribute->name.": ";

               if($attributes->attribute->type=='input' || $attributes->attribute->type=='textarea')
               {
                  $productAttribute.=$attributes->values;
               }

               if($attributes->attribute->type=='selectbox')
               {
                  if($attributes->values)
                  {
                     $val     =   AttributeValue::where('id',$attributes->values)->first();
                     $productAttribute.=$val->value;
                  }
               }

               if($attributes->attribute->type=='mselectbox')
               {
                  if($attributes->values)
                  {
                     $valid = $attributes->values;

                     // check single or multiple
                     if(@strpos($valid,',') !== false)
                     {
                           $pvalue 	=	@explode(',',$valid);
                           foreach($pvalue as $values)
                           {
                              $val     =   AttributeValue::where('id',$values)->first();
                              if($val)
                              {
                                 $productAttribute.=$val->value;
                                 $productAttribute.=", ";
                              }
                           }
                     }
                     else
                     {
                           $val     =   AttributeValue::where('id',$valid)->first();
                           if($val)
                           {
                              $productAttribute.=$val->value;
                           }
                     } 
                  }
               }

               $productAttribute.='</li>';
         }
      }

      // Check product in cart
      $cart          =     '';
      $productid     =     $pdetail->id;
      $sessionid     =     Session::getId();
      $product       =     Cart::where('sessionid',$sessionid)->where('product_id',$productid)->first();
      if($product)
      {
         $cart       =     'exist';
      }
      $data          =     compact('pdetail','productAttribute','similar','cart');

      return view('product.detail')->with($data);
   }

}
