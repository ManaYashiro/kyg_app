import "./bootstrap";

import Alpine from "alpinejs";
import moment from "moment";

window.Alpine = Alpine;
window.moment = moment;

Alpine.start();

import "./postalCodeSearch.js";
import "./notification.js";
import "./session.js";
import "./top.js";
