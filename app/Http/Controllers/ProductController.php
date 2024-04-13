<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Color;
use App\Models\Attribute;
use App\Models\ProductCollection;
use App\Models\ProductColor;
use App\Models\ProductTypeCollection;
use App\Models\ProductTypeAttribute;
use App\Models\Producttype;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\PriceRange;

class ProductController extends Controller
{
   public function products_celebrity()
   {
      $product    =  Product::where('status','4')->where('is_celeb','Yes')->get();
      $data       =  compact('product');

      return view('product.celebrity')->with($data);
   }

   public function products_newarrival()
   {
      $product    =  Product::where('status','4')->orderby('id','desc')->get();
      $data       =  compact('product');

      return view('product.newarrival')->with($data);
   }

   public function products_festival()
   {
      $product    =  Product::where('status','4')->get();
      $data       =  compact('product');

      return view('product.festival')->with($data);
   }

   public function products_deal()
   {
      $product    =  Product::where('status','4')->get();
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
      $ptype                  =   Producttype::where('slug',$slug)->first();
      if($ptype)
      {
         $ptypeid             =   $ptype['id'];
         $filtering           =   'No';

         $req_collection      =   request()->get('collection');         
         $req_color           =   request()->get('color');
         $req_price           =   request()->get('price');
         $req_customname      =   request()->get('custom_name');
         $req_customname      =   request()->get('custom_value');

         $leftreq['collection']       =   $req_collections     =   @explode(',',$req_collection);
         $leftreq['color']            =   $req_colors          =   @explode(',',$req_color);
         $req_prices                  =   @explode('-',$req_price);
         $leftreq['price']            =   $req_price;
         
         // Make a Side Bar
         $side['side_collection']     =   ProductTypeCollection::where('producttype_id',$ptypeid)->get();
         $side['side_color']          =   color::get();
         $side['side_price']          =   PriceRange::get();
         $side['side_custom']         =   array();

         // Custom Attributes
         // $s_attri                     =   ProductTypeAttribute::whereRelation('attribute', 'leftside_filter', '=', 'Yes')
         //                                  ->where('producttype_id',$ptypeid)
         //                                  ->get();
         // if($s_attri)
         // {
         //    foreach($s_attri as $key=>$s_attris)
         //    {
         //       $s_attvalue            =   AttributeValue::where('attribute_id',$s_attris['attribute_id'])->get();
               
         //       $side['side_custom'][$key]['col'] =   array();
               
         //       if($s_attvalue)
         //       {
         //          $side['side_custom'][$key]['label']  =  $s_attris['attribute']['name'];
                  
         //          foreach($s_attvalue as $key1=>$s_attvalues)
         //          {
         //             $side['side_custom'][$key]['col'][$key1]['id']     =  $s_attvalues['id'];
         //             $side['side_custom'][$key]['col'][$key1]['value']  =  $s_attvalues['value'];
         //          }
         //       }
         //    }
         // }

         // Get Product Ids By Filtering
         if(request()->query())
         {
            $filtering                 =  'Yes';
            $product                   =   array();
            $fetch_product_id          =   array();

            $product                   =   Product::where('producttype_id',$ptypeid);

            if($req_collection)
            {
               $req_productinfo        =   ProductCollection::whereIn('collection_id',$req_collections)->get();
               if($req_productinfo)
               {
                  foreach($req_productinfo as $req_productinfos)
                  {
                     $fetch_product_id[]     =  $req_productinfos['product_id'];
                  }
               }

               $product      =  $product->whereIn('id',$fetch_product_id);
            }

            if($req_color)
            {
               $req_productinfo        =   ProductColor::whereIn('color_id',$req_colors)->get();
               if($req_productinfo)
               {
                  foreach($req_productinfo as $req_productinfos)
                  {
                     $fetch_product_id[]     =  $req_productinfos['product_id'];
                  }
               }

               $product      =  $product->whereIn('id',$fetch_product_id);
            }

            if($req_price)
            {
               $req_prices[0] =  $req_prices[0]-1;
               $req_prices[1] =  $req_prices[1]+1;
               $product       =  $product->where('selling_price','>',$req_prices[0])->where('selling_price','<',$req_prices[1]);
            }

            $product          =   $product->get();

            $data             =   compact('ptype','side','filtering','leftreq','product');

         }
         else
         {
            $leftreq['collection']       =   array();
            $leftreq['color']            =   array();
            $leftreq['price']            =   array();
            
            $product    =  Product::where('producttype_id',$ptypeid)->get();
            $data       =  compact('ptype','side','filtering','leftreq','product');
         }

         return view('product.ptype')->with($data);
      }
      else
      {
         return view('no_found');
      }
   }

   public function products_ptype_att_search(Request $request)
   {
      // echo '<pre>';
      // print_r($_REQUEST);

      if($request)
      {
         $ptype         = $request->ptype;
         $collection    = $request->collection;
         $color         = $request->color;
         $price         = $request->price;
         $input_custom  = $request->input_custom;

         $string        =  "products/".$ptype."?";
         
         if($collection) 
         { 
            $collections = @implode(',',$collection); 
            $string.= "collection=$collections&";
         }
         if($color)      
         { 
            $colors      = @implode(',',$color); 
            $string.= "color=$colors&";
         }
         if($price)      
         { 
            $string.= "price=$price";
         }

         return redirect($string);
      }
      else
      {
         return redirect('/404-page-not-found');
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
                     if($val)
                     {
                        $productAttribute.=$val->value;
                     }                     
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
