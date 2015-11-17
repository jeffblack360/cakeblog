/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Create product model
(function (myApp) {
    
    // Product Constructor Function
    function Product() {
        var self = this;
        
        self.sku = ko.observable("");
        self.desciption = ko.observable("");
        self.price = ko.observable("");
        self.cost = ko.observable("");
        self.quantity = ko.observable("");
    }
    
    // add to our namespace
    myApp.Product = Product;
    
} (window.myApp));