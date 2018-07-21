"use strict";

const  alphaNumRegex = /^[a-zA-Z0-9]+$/;
const  addressRegex = /^[a-zA-Z][a-zA-Z0-9, ]+$/;
const  surnameRegex = /^[a-zA-Z]\' ]+$/;
const  alphaRegex = /^[a-zA-Z]+$/;
const  emailRegex = /^[a-zA-Z0-9]([a-zA-Z0-9]?|[\w\._]*[a-zA-Z0-9])@[a-z\.]+\.[a-z]{2,}$/;
const  numRegex = /^[0-9]+$/;
const  passwordRegex = [/[A-Z]/, /[a-z]/, /[0-9]/, /[^A-Za-z0-9]/];
