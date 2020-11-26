<div class="modal fade" id="cart-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="cart-form" ng-submit="onCompleteOrder()">
                    <div class="modal-header">
                        <h3>Cart</h3>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container">
                                <div class="card mb-2" ng-repeat="(key, product) in cartProducts">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-around">
                                            <img width="100" height="100" ng-src="<%= product.image_link %>" alt="Product Image">
                                            <div class="d-flex justify-content-between flex-column">
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group">
                                                        <input id="product-<%= product.id %>" readonly type="text" class="form-control text-capitalize" ng-model="product.name">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" id="product-<%= product.id %>-quantity"" class="form-control" min="1" max="<%= product.total_quantity %>" ng-model="product.quantity" required>
                                                    </div>
                                                    <div>
                                                        <button ng-click="deleteProductFromCart(product.id)" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p><%= product.description %></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('labels.confirm') }}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('labels.close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
