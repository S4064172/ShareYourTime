"use strict";

/*******************Costanti DataBase********************/
const UserNameMaxLength = 25;
const UserNameMinLength = 5;
const PasswordMaxLength = 255;
const PasswordMinLength = 8;
const NameMaxLength = 30;
const NameMinLength = 2;
const SurnameMaxLength = 30;
const SurnameMinLength = 2;
const EmailMaxLength = 125;
const EmailMinLength = 6;
const StreetMaxLength = 125;
const StreetMinLength = 6;
const PhotoMaxLength = 50;
const PhoneLength = 10;
const DescriptionMinLength = 10;
const DescriptionMaxLength = 150;
const TagMaxLength = 20;
const CostMin = 0;
const DistanceMin = 0;


/*******************Costanti Regex********************/
const  alphaNumRegex = /^[a-zA-Z0-9 ]+$/;
const  addressRegex = /^[a-zA-Z0-9]([a-zA-Z0-9, ']|[^\x00-\x7f])+$/;///^[a-zA-Z][a-zA-Z0-9, ']+$/;
const  surnameRegex = /^[a-zA-Z\' ]+$/;
const  alphaRegex = /^[a-zA-Z]+$/;
const  emailRegex = /^[a-zA-Z0-9]([a-zA-Z0-9]?|[\w\._]*[a-zA-Z0-9])@[a-z\.]+\.[a-z]{2,}$/;
const  numRegex = /^[0-9]+$/;
const  passwordRegex = [/[A-Z]/, /[a-z]/, /[0-9]/, /[^A-Za-z0-9]/];
