@extends('welcome')

@section('script')
    <script>
        function add(element){

            if(element.getAttribute('name') !== 'add'){
                var value = element.getAttribute('value');
                $('#edit' + element.getAttribute('name')).val($('#edit' + element.getAttribute('name')).val() + value)
            }else{
                var value = element.getAttribute('value');
                $('#tekst').val($('#tekst').val() + value)
            }



        }

    </script>
@endsection

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="#">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Custom Fields</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Kategorie produktów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/etykiety">Etykiety</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/gateways">Bramki SMS</a>
    </li>
    <li class="nav-item active">
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
        <th>Name</th>
        <th>Content</th>
        <th style="text-align: end"><button class="btn btn-primary" data-toggle="modal" data-target="#addTemplate"><i class="fa fa-plus"></i> Dodaj Szablon</button></th>
    </tr>
    </thead>
    <tbody>
        @foreach($templates as $template)
        <tr>
            <td>{{$template->name}}</td>
            <td>{{ \Illuminate\Support\Str::limit($template->content, 90, $end='...') }}</td>
            <td>
                <button data-toggle="modal" data-target="#{{$template->name}}">Edytuj</button>
                <form class="delete{{$template->name}}" style="display: none" action="/deleteTemplate">
                    <input name="templateName" value="{{$template->name}}" type="hidden">
                </form>
                <button onclick="submit('delete{{$template->name}}')">Usuń</button>
            </td>
        </tr>

        <div class="modal fade" id="{{$template->name}}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">'{{$template->name}}' Template Edition</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form class="{{$template->name}}" action="/editTemplate">
                            <div class="col-sm-6">
                                <input type="hidden" value="{{$template->id}}" name="id">
                                <div class="form-group">
                                    <label>Nazwa:</label>
                                    <input type="text" class="form-control" name="name" value="{{$template->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Tekst:</label>
                                    <textarea id="edit{{$template->name}}" class="form-control" rows="5" name="content" required>{{$template->content}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                @foreach($variables as $category=>$tplvariables)
                                    <div class="template-variable-category" data-toggle="collapse" data-target="#{{$category}}">{{$category}} </div>
                                    <div id="{{$category}}" class="collapse template-variable-container">
                                        @foreach($tplvariables as $variable)
                                            <div class="template-variable" onclick="add(this)" name="{{$template->name}}" value="{{$variable}}">{{$variable}}</div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="submit('{{$template->name}}')" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="addTemplate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body row">
                <div class="col-sm-6">
                    <form class="addTemplateForm" action="/addTemplate">
                        <div class="form-group">
                            <label>Nazwa:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Tekst:</label>
                            <textarea id="tekst" class="form-control" rows="5" name="content" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    @foreach($variables as $category=>$tplvariables)
                        <div class="template-variable-category" data-toggle="collapse" data-target="#{{$category}}">{{$category}} </div>
                        <div id="{{$category}}" class="collapse template-variable-container">
                            @foreach($tplvariables as $variable)
                                <div class="template-variable" onclick="add(this)" name="add" value="{{$variable}}">{{$variable}}</div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="submit('addTemplateForm')" data-dismiss="modal">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection




