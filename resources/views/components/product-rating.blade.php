@php 
$rate = 0;
if($product->ratings)
{
    $should_rate = count($product->ratings)*5;
    $actual_rate = $product->ratings->sum('rating');
    
    if(count($product->ratings)!=0)
    {
        $rate = ($actual_rate/$should_rate)*5;
        $rate = round($rate);
    }

    if($rate!=0)
    {
        $i = $rate;
        
        echo "<div class='rating'>";
        while ($i > 0) 
        { 
            echo "<i class='fa fa-star'></i>";
            $i--; 
        }

        if($label=='yes')
        {
            echo "<span>(". count($product->ratings) ." rating )</span>";
        }

        echo "</div>";
    }
}
@endphp