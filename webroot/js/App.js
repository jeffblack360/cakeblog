/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global ko */

// Class to represent a row in the seat reservations grid
function SeatReservation(name, initialMeal) {
    var self = this;

    self.name = name;
    self.meal = ko.observable(initialMeal);

    self.formattedPrice = ko.computed(function () {
        var price = self.meal().price;
        return price ? "$" + price.toFixed(2) : "None";
    });
}

// This is a simple *viewmodel* - JavaScript that defines the data and behavior of your UI
function AppViewModel() {

    var self = this;

    self.firstName = ko.observable("Bert");
    self.lastName = ko.observable("Bertington");

    self.fullName = ko.computed(function () {
        return self.firstName() + " " + self.lastName();
    }, self);

    this.capitalizeLastName = function () {
        var currentVal = self.lastName();        // Read the current value
        self.lastName(currentVal.toUpperCase()); // Write back a modified value
    };

    // Non-editable catalog data - would come from the server
    self.availableMeals = [
        {mealName: "Standard (sandwich)", price: 0},
        {mealName: "Premium (lobster)", price: 34.95},
        {mealName: "Ultimate (whole zebra)", price: 290}
    ];

    // Editable data
    self.seats = ko.observableArray([
        new SeatReservation("Steve", self.availableMeals[0]),
        new SeatReservation("Bert", self.availableMeals[0])
    ]);

    // Computed data
    self.totalSurcharge = ko.computed(function () {
        var total = 0;
        for (var i = 0; i < self.seats().length; i++)
            total += self.seats()[i].meal().price;
        return total;
    });

    // Operations
    self.addSeat = function () {
        self.seats.push(new SeatReservation("", self.availableMeals[0]));
    };

    self.removeSeat = function (seat) {
        self.seats.remove(seat);
    };
}


// Activates knockout.js
ko.applyBindings(new AppViewModel());