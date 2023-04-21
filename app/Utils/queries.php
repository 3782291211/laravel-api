<?php
namespace App\Utils;

use Illuminate\Http\Request;

// can delete this if not implementing any queries!
// the querystring contains user input

class ProductQuery
{
    protected $allowedFields = [
        'name', 'description', 'slug'
    ];

    public function transform(Request $request)
    {

    }
}

 // filtering data
       // $filter = new ProductQuery();
       // $queryItems = $filter->transform($request); // $queryItems will be an array with this structure: [['column', 'operator', 'value'], ['column', 'operator', 'value'], ...]

        //if (count($queryItems) == 0)
        //{
            //return new ProductCollection(Product::paginate());
       /* }
        else
        {
            return new ProductCollection(Product::where($queryItems)->paginate(10));
        }*/

        # the all() method on our model gets all of the models from the database
        // return new ProductCollection(Product::paginate(10));
        //return Product::all();