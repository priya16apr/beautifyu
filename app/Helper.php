<?php

use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\ProductType;
use App\Models\ProductTypeCollection;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

if(!function_exists('getMenu'))
{
    function getMenu()
    {
        $subcat =   SubCategory::where('is_visible','1')->orderBy('sequence','asc')->get();
        if($subcat)
        {
            foreach($subcat as $subcats)
            {
                $subcatid      =   $subcats['id'];
                $subcatname    =   $subcats['title'];
                $subcatslug    =   $subcats['slug'];
                
                echo "<li class='nav-item dropdown megamenu'><a id='megamneu' href='' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='nav-link dropdown-toggle'>".$subcatname."</a>
                        <div aria-labelledby='megamneu' class='dropdown-menu border-0 p-0 m-0'>
                            <div><div class='row bg-white rounded-0 m-0 shadow-sm'><div class='col-lg-12 col-xl-12'><div class='p-4'><div class='menu-boxx'>";

                            $ptype      =   ProductType::where('is_visible','1')->orderBy('sequence','asc')->where('sub_category_id',$subcatid)->get();
                            if($ptype)
                            {  
                                foreach($ptype as $ptypes)
                                {   
                                    $ptypeid      =   $ptypes['id'];
                                    $ptypeslug    =   $ptypes['slug'];
                                    $ptypename    =   $ptypes['title'];
                                    $fslug        =   "/products/".$ptypeslug;
                                    
                                    echo "<div class='boxx-3 mb-4'>";
                                    echo "<h6><a href=".$fslug.">".$ptypename."</a></h6>";
                                    echo "<ul class='list-unstyled'>";

                                    $collection             =   ProductTypeCollection::where('is_visible','1')->orderBy('sequence','asc')->where('producttype_id',$ptypeid)->get();
                                    if($collection)
                                    { 
                                        foreach($collection as $collections)
                                        { 
                                        
                                            $collectionid       =   $collections['id'];
                                            $collectionslug     =   $collections['slug'];
                                            $collectionname     =   $collections['title'];
                                            $fcolslug           =   "/products/".$ptypeslug.'?collection='.$collectionid;

                                            echo '<li class="nav-item"><a href='.$fcolslug.' class="nav-link text-small pb-0">'.$collectionname.'</a></li>';
                                        }    
                                    }

                                    echo "</ul>";
                                    echo "</div>";
                                }
                            }

                            echo "</div></div></div></div></div>
                        </div>
                    </li>";
            }
        }

        echo '<li class="nav-item"><a href="'.route('products_celebrity').'" class="nav-link">Celebrity Special</a></li>';
        echo '<li class="nav-item"><a href="'.route('products_newarrival').'" class="nav-link">New Arrivals</a></li>';
        // echo '<li class="nav-item"><a href="'.route('products_festival').'" class="nav-link">Festival Special</a></li>';
        echo '<li class="nav-item"><a href="'.route('products_deal').'" class="nav-link">Deals of the Day</a></li>';
        echo '<li class="nav-item"><a href="'.route('happy_customer').'" class="nav-link">Happy Customer</a></li>';
    }
}

if(!function_exists('getFooterMenu'))
{
    function getFooterMenu()
    {
        $ptype      =   ProductType::where('is_visible','1')->orderBy('sequence','asc')->get();
        if($ptype)
        {  
            foreach($ptype as $ptypes)
            {   
                $ptypeid      =   $ptypes['id'];
                $ptypeslug    =   $ptypes['slug'];
                $ptypename    =   $ptypes['title'];
                $fslug        =   "/products/".$ptypeslug;
                
                echo "<b><a href=".$fslug.">".$ptypename."</a></b> : ";

                $collection             =   ProductTypeCollection::where('is_visible','1')->orderBy('sequence','asc')->where('producttype_id',$ptypeid)->get();
                if($collection)
                { 
                    foreach($collection as $collections)
                    { 
                    
                        $collectionid       =   $collections['id'];
                        $collectionslug     =   $collections['slug'];
                        $collectionname     =   $collections['title'];
                        $fcolslug           =   "/products/".$ptypeslug.'?collection='.$collectionid;

                        echo '<a href='.$fcolslug.' >'.$collectionname.'</a> | ';
                    }    
                }

                echo "<br/>";
            }
        } 
    }
}

if(!function_exists('getAllSetting'))
{
    function getAllSetting()
    {
        $setting =   Setting::get();
        if($setting)
        {
            $data = array();

            foreach($setting as $settings)
            {
                $data[$settings['name']] = $settings['value'];
            }
            return $data;
        }
    }
}

if(!function_exists('getSetting'))
{
    function getSetting($name=null)
    {
        $info   =   Setting::where('name',$name)->first();
        if($info)
        {
            return $info->value;
        }
    }
}

if(!function_exists('getSideBarHierarchy'))
{
    function getSideBarHierarchy($selattribute=null)
    {
        $subcat     =     SubCategory::where('is_visible','1')->orderBy('sequence','asc')->get();
        if($subcat)
        {
            foreach($subcat as $subcats)
            {
                $scat_id    = $subcats['id'];
                $scat_name  = $subcats['title'];
                
                echo "<div class='card'>";
                    echo "<div class='card-heading'><a data-toggle='collapse' data-target='#collapse".$scat_id."'>".$scat_name."</a></div>";
                    
                    $ptype      =   ProductType::where('is_visible','1')->orderBy('sequence','asc')->where('sub_category_id',$scat_id)->get();
                    if($ptype)
                    {
                        echo "<div id='collapse".$scat_id."' class='collapse' data-parent='#accordionExample'><div class='card-body'><ul>";
                        foreach($ptype as $ptypes)
                        {
                            echo "<li><a href='/products/".$ptypes['slug']."'>".$ptypes['title']."</a></li>";
                        }
                        echo "</ul></div></div>";
                    }
                echo "</div>";
            }
        }
    }
}

if(!function_exists('getSideBarHierarchyMob'))
{
    function getSideBarHierarchyMob($selattribute=null)
    {
        $subcat     =     SubCategory::where('is_visible','1')->orderBy('sequence','asc')->get();
        if($subcat)
        {
            foreach($subcat as $subcats)
            {
                $scat_id    = $subcats['id'];
                $scat_name  = $subcats['title'];
                
                echo "<div class='card'>";
                    echo "<div class='card-heading'><a data-toggle='collapse' data-target='#collapse".$scat_id."'>".$scat_name."</a></div>";
                    
                    $ptype      =   ProductType::where('is_visible','1')->orderBy('sequence','asc')->where('sub_category_id',$scat_id)->get();
                    if($ptype)
                    {
                        echo "<div id='collapse".$scat_id."' class='collapse' data-parent='#accordionExample'><div class='card-body'><ul>";
                        foreach($ptype as $ptypes)
                        {
                            echo "<li><a href='/products/".$ptypes['slug']."'>".$ptypes['title']."</a></li>";
                        }
                        echo "</ul></div></div>";
                    }
                echo "</div>";
            }
        }
    }
}

function sendMail($template,$body_param,$header_param)
{
    // Mail::send($template,$body_param, function($message) use ($header_param) {
    //     $message->to($header_param['to']);
    //     $message->from('beautifyu@gmail.com','Beautify U');
    //     $message->subject($header_param['subject']);
    // });

    //echo 'Mail send';
}


?>