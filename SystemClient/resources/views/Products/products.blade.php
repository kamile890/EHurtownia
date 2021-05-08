@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="/dealers">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/clients">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/customFields">Custom Fields</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/categories">Kategorie produktów</a>
    </li>
    <li class="nav-item  active">
        <a class="nav-link" href="/products">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/labels">Etykiety</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/gateways">Bramki SMS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/templatesList">Szablony SMS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/settings">Ustawienia</a>
    </li>
@endsection

@section('body')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Cena (zł)</th>
            <th>Obrazek</th>
            <th>Ilość</th>
            <th>Kategoria</th>
            <th style="text-align: end"><button class="btn btn-primary" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus"></i> Dodaj Produkt</button></th>

        </tr>

        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td>{{$product['name']}}</td>
                <td>{{$product['price']}}</td>
                <td></td>
                <td>{{$product['amount']}}</td>
                <td>{{$category[$product['category_id'] -1]->name}}</td>
                <td style="text-align: end"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a{{$product['name']}}">
                        Edytuj
                    </button></td>

                <div class="modal fade" id="a{{$product['name']}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja produktu '{{$product['name']}}'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="aa{{$product['name']}}" action="/editProduct">
                                    <input type="hidden" class="form-control" name="id" value="{{$product['id']}}" required>
                                    <div class="form-group">
                                        <label for="pwd">Nazwa:</label>
                                        <input type="text" class="form-control" value="{{$product['name']}}" name="name"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Cena:</label>
                                        <input type="number" step="0.01" min="0.01" class="form-control" value="{{$product['price']}}" name="price"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Obrazek:</label>
                                        <input type="file"  class="form-control" accept="image/*" value="{{$product['image_path']}}" name="image_path"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Ilość:</label>
                                        <input type="number"  class="form-control" min="0" value="{{$product['amount']}}" name="amount"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Kategoria:</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($category as $cat)
                                                <option @if($cat['id'] == $product['category_id']) selected @endif value="{{$cat['id']}}">{{$cat['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="submit('aa{{$product['name']}}')" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addProduct">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="col-sm-12">
                        <form class="addProductForm" action="/addProduct">
                            <div class="form-group">
                                <label>Nazwa:</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Cena:</label>
                                <input type="number" step="0.01" min="0.01" class="form-control" name="price"/>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Obrazek:</label>
                                <input type="file" accept="image/*" class="form-control" name="image_path"/>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Ilość:</label>
                                <input type="number" min="0" class="form-control" name="amount"/>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Kategoria:</label>
                                <select class="form-control" name="category_id">
                                    @foreach($category as $cat)
                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submit('addProductForm')" data-dismiss="modal">Add Product</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection





