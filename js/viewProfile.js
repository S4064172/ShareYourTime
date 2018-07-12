"use strict";

/** @description
 *  Questa funzione permette
 *  di togliere il tag
 *  readonly dai campi
 *  in gestione profilo
 */

 function removeReadOnly() {
    document.getElementById("userModified").readOnly = false;
    document.getElementById("emailModified").readOnly = false;
    document.getElementById("pswModified").readOnly = false;
    document.getElementById("nameModified").readOnly = false;
    document.getElementById("surnameModified").readOnly = false;
    document.getElementById("addressModified").readOnly = false;
    document.getElementById("phoneModified").readOnly = false;
 }

 /** @description
 *  Questa funzione permette
 *  di mettere il tag
 *  readonly dai campi
 *  in gestione profilo
 */
function addReadOnly() {
    document.getElementById("userModified").readOnly = true;
    document.getElementById("emailModified").readOnly = true;
    document.getElementById("pswModified").readOnly = true;
    document.getElementById("nameModified").readOnly = true;
    document.getElementById("surnameModified").readOnly = true;
    document.getElementById("addressModified").readOnly = true;
    document.getElementById("phoneModified").readOnly = true;
 }