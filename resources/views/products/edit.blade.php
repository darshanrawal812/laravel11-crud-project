<!-- This is edit page  -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">
            Project lv11 - Updating Details
        </h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h4>Edit Product</h4>
                    </div>
                    <form enctype="multipart/form-data" action="{{route('products.update', $product->id) }}" , method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="@error( 'name' ) is-invalid @enderror form-label h5">Name</label>
                                <input value="{{ old('name', $product->name) }}" type="text" name="name" class="form-control" placeholder="Name">
                                @error('name')
                                <p class="invalid-feedback">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="@error( 'sku' ) is-invalid @enderror form-label h5">Sku</label>
                                <input value="{{ old('sku', $product->sku) }}" type="text" name="sku" class="form-control" placeholder="Sku">
                                @error('sku')
                                <p class="invalid-feedback">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="@error( 'price' ) is-invalid @enderror form-label h5">Price</label>
                                <input value="{{ old('price', $product->price) }}" type="text" name="price" class="form-control" placeholder="Price">
                                @error('price')
                                <p class="invalid-feedback">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description" rows="5">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label h5">Image</label>
                                <input type="file" name="image" class="form-control" placeholder="Image">
                                @if ($product->image)
                                <div class="mt-2">
                                    <img class="w-20" src="{{ asset('uploads/images/' . $product->image) }}" alt="{{ $product->name }}">
                                </div>
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-dark">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>