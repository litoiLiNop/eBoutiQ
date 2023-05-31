@extends('frontend.master_dashboard')
@section('main')

@section('title')
    Liste d'Achats
@endsection

<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Accueil</a>
                    <span></span> Liste d'Achats
                </div>
            </div>
        </div>
        <div class="container mb-30 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="mb-50">
                        <h1 class="heading-2 mb-10">Ta Liste d'Achats</h1>
                        <h6 class="text-body">There are products in this list</h6>
                    </div>
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">

                                    </th>
                                    <th scope="col" colspan="2">Article</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col"> Statut</th>

                                    <th scope="col" class="end">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody id="wishlist">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



@endsection
