/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Products ViewModel
(function (myApp) {
    
    // Constructor Function
    function ProductsViewModel() {
        var self = this;
       
        // the product that we want to view/edit
        self.selectedProduct = ko.observable();
        
        // the product collection
        self.productCollection = ko.observableArray([]);
    }
    
    // add to our ViewModel to the public namespace
    myApp.ProductsViewModel = ProductsViewModel;
    
} (window.myApp));