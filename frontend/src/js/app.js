import "../sass/app.scss"
import "bootstrap/dist/js/bootstrap.bundle.min"
import "./sweetalert";
import Search from "./search";
import List from "./list";

window.Vehicles = new List();
window.Search = new Search();

Vehicles.load()