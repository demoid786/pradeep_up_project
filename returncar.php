<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
<style>

#page{
	width:100%;
	height:100%;
	position:relative;
	margin-top:15px;
	display:none;
}

.payment-card{
  position: relative;
  width: 60rem;  
  padding-bottom: 3.5rem;
}

.payment-card__front{
  width: 65%;
  padding: 5%;
  
  border-radius: 10px;
  background-color: #f0f0ee;
  box-shadow: 0 0 10px #f4f4f2;
  border: 1px solid #a29e97;

  position: relative;
  z-index: 1;
}

.payment-card__back{
  width: 65%;
  padding: 25% 5% 10%;
  text-align: right;
  
  border-radius: 10px;
  border: 1px solid #dad9d6;
  background-color: #e0ddd7;
  box-shadow: 0 0 20px #f3f3f3;

  position: absolute;
  bottom: 0;
  right: 0;
}

.payment-card__back:before{
  content: "";
  width: 100%;
  height: 6.5rem;
  background-color: #8e8b85;

  position: absolute;
  top: 3.5rem;
  right: 0;
}

.payment-card__group:nth-child(n+2){
  margin-top: 2rem;
}

.payment-card__field{
  display: inline-block;
  vertical-align: middle;
  width: 100%;
}

.payment-card__month, .payment-card__year, .payment-card__cvc{
  width: 25%;
}

.payment-card__hint{
  position: absolute;
  left: -9999px;
}

.payment-card__input{
  box-sizing: border-box;
  width: 100%;
  padding: 1rem;
  border: 3px solid #d0d0ce;  
  
  font-family: inherit;
  font-size: 100%;
}

.payment-card__input:focus{
  outline: none;
  border-color: #fdde60;
}

.payment-card__caption{
  text-transform: uppercase;
  font-size: 1.2rem;
}

.payment-card__separator{
  font-size: 3.2rem;
  color: #c4c4c3;

  margin-left: 1.2rem;
  margin-right: 1.2rem;
  display: inline-block;
  vertical-align: middle;
}

.payment-card__footer{
  background-repeat: no-repeat;
  background-position: calc(100% - 6.2rem) 50%, 100% 50%;
  background-size: 5.2rem;  
  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSIzNiIgdmlld0JveD0iMCAwIDMwMCAxODAiPjxwYXRoIGQ9Ik0yOTguMDMyIDkwLjVjLjAxNCA0OC45MzYtMzkuNjQ2IDg4LjYxNC04OC41ODIgODguNjI3LTQ4LjkzNy4wMTItODguNjE0LTM5LjY0Ni04OC42MjctODguNTgyVjkwLjVjLS4wMTMtNDguOTM1IDM5LjY0Ny04OC42MTUgODguNTgxLTg4LjYyOCA0OC45MzctLjAxMyA4OC42MTUgMzkuNjQ3IDg4LjYyOCA4OC41ODN2LjA0NXoiIGZpbGw9IiNmOTAiLz48cGF0aCBkPSJNOTAuMDAxIDEuODk1QzQxLjM1NSAyLjIwNCAxLjk2NyA0MS43ODEgMS45NjcgOTAuNWMwIDQ4LjkwOSAzOS42OTUgODguNjA0IDg4LjYwNSA4OC42MDQgMjIuOTU1IDAgNDMuODc5LTguNzQ4IDU5LjYyNC0yMy4wODZsLS4wMDctLjAwNGguMDE5YTg5LjQzNyA4OS40MzcgMCAwIDAgOC45OTUtOS40ODhIMTQxLjA1YTg2LjUzNiA4Ni41MzYgMCAwIDEtNi42MDYtOS4xMjdoMzEuMzA4YTg4Ljc1IDg4Ljc1IDAgMCAwIDUuMTU4LTkuNDg4aC00MS42MzVhODcuMzkyIDg3LjM5MiAwIDAgMS0zLjcwMy05LjMwOWg0OS4wNDVhODguMzg4IDg4LjM4OCAwIDAgMCA0LjU2LTI4LjEwM2MwLTYuNTEyLS43MDYtMTIuODYxLTIuMDQyLTE4Ljk3NGgtNTQuMTY0YTg4LjM0NyA4OC4zNDcgMCAwIDEgMi41MjgtOS4zMDhoNDkuMDYzYTg4LjYxOCA4OC42MTggMCAwIDAtMy44Mi05LjQ4N0gxMjkuMjdhODUuMDEzIDg1LjAxMyAwIDAgMSA1LjA4NC05LjMwN2gzMS4yODVhODguNzk4IDg4Ljc5OCAwIDAgMC02Ljg3Ny05LjQ4OGgtMTcuNDQzYTgyLjIzMiA4Mi4yMzIgMCAwIDEgOC44ODktOC45NWMtMTUuNzQ2LTE0LjM0LTM2LjY3Ni0yMy4wOS01OS42MzYtMjMuMDloLS41NzF6IiBmaWxsPSIjYzAwIi8+PHBhdGggZD0iTTI4OS4xNDMgMTM2LjgyYy40ODIgMCAuOTUxLjEyNSAxLjQwOS4zNzEuNDYuMjQ2LjgxNC42MDEgMS4wNyAxLjA2Mi4yNTYuNDU2LjM4NC45MzcuMzg0IDEuNDM1IDAgLjQ5Mi0uMTI3Ljk2OC0uMzc5IDEuNDI0LS4yNTEuNDU1LS42MDUuODEtMS4wNjEgMS4wNjMtLjQ1MS4yNDktLjkyOC4zNzUtMS40MjQuMzc1cy0uOTcyLS4xMjYtMS40MjYtLjM3NWEyLjcxIDIuNzEgMCAwIDEtMS4wNjMtMS4wNjMgMi45MDggMi45MDggMCAwIDEtLjM3Ny0xLjQyNGMwLS40OTguMTI3LS45NzkuMzg0LTEuNDM1YTIuNjYzIDIuNjYzIDAgMCAxIDEuMDcxLTEuMDYyIDIuOTcgMi45NyAwIDAgMSAxLjQxMi0uMzcxbTAgLjQ3NWMtLjQwMSAwLS43OTMuMTA0LTEuMTc2LjMxMS0uMzguMjA3LS42NzcuNS0uODkxLjg4OGEyLjM3OCAyLjM3OCAwIDAgMC0uMzI1IDEuMTk0YzAgLjQxMi4xMDYuODEuMzE1IDEuMTg4LjIxNC4zNzcuNTEuNjczLjg4OC44ODUuMzgxLjIxMS43NzYuMzE1IDEuMTg4LjMxNS40MTQgMCAuODEtLjEwNCAxLjE4OS0uMzE1LjM3OC0uMjEyLjY3My0uNTA4Ljg4NC0uODg1YTIuMzkyIDIuMzkyIDAgMCAwLS4wMDgtMi4zODIgMi4xNzkgMi4xNzkgMCAwIDAtLjg5NC0uODg4IDIuNDAyIDIuNDAyIDAgMCAwLTEuMTctLjMxMW0tMS4yNTYgMy45NzV2LTMuMDgyaDEuMDYyYy4zNiAwIC42MjIuMDI4Ljc4NC4wODhhLjc1OC43NTggMCAwIDEgLjM4OC4yOTcuODEzLjgxMyAwIDAgMS0uMDk4IDEuMDM5Ljk0OS45NDkgMCAwIDEtLjYzOS4yODEuODk2Ljg5NiAwIDAgMSAuMjY0LjE2NGMuMTI1LjEyLjI3NS4zMjMuNDU1LjYxbC4zNzUuNjAzaC0uNjA2bC0uMjcyLS40ODVjLS4yMTUtLjM4Mi0uMzg4LS42Mi0uNTIxLS43MTgtLjA5MS0uMDY5LS4yMjQtLjEwNS0uMzk3LS4xMDVoLS4yOTN2MS4zMTFoLS41bS40OTYtMS43MzhoLjYwNGMuMjg4IDAgLjQ4My0uMDQ0LjU4OC0uMTI5YS40MjEuNDIxIDAgMCAwIC4xNTktLjM0Mi40MDQuNDA0IDAgMCAwLS4wNzUtLjI0NC40NjYuNDY2IDAgMCAwLS4yMTMtLjE2MmMtLjA4OS0uMDM1LS4yNTUtLjA1NS0uNDk3LS4wNTVoLS41NjR2LjkzMiIgZmlsbD0iI2ZjYjM0MCIvPjxnPjxwYXRoIGQ9Ik0xMTkuOTc1IDExNS45MmwxLjE4LTguMDJjLS42NDUgMC0xLjU5My4yNzktMi40MzEuMjc5LTMuMjg0IDAtMy42OTQtMS43NTUtMy40MzYtMy4wMzdsMy4yMzYtMTYuMTNoNC45OTJsMS4wMjktOS4xMDNoLTQuNzA1bC45NTgtNS41MTZoLTkuODQyYy0uMjA4LjIwOC01LjU2OCAzMS4wMjItNS41NjggMzQuNzc2IDAgNS41NTUgMy4xMTggOC4wMjcgNy41MTYgNy45ODggMy40NDItLjAzIDYuMTI1LS45ODIgNy4wNzEtMS4yMzd6TTEyMi45NjIgMTAwLjYzMmMwIDEzLjMzMiA4Ljc5OSAxNi40OTkgMTYuMjk3IDE2LjQ5OSA2LjkyMSAwIDEwLjU1LTEuNjA0IDEwLjU1LTEuNjA0bDEuNjYyLTkuMXMtNS44NDggMi4zNzgtMTAuNjAxIDIuMzc4Yy0xMC4xMzEgMC04LjM1NS03LjU1NC04LjM1NS03LjU1NGwxOS40NjMuMDU5czEuMjM5LTYuMTExIDEuMjM5LTguNjAyYzAtNi4yMTctMy4zODctMTMuODUtMTMuNzQ1LTEzLjg1LTkuNDg2LjAwMy0xNi41MSAxMC4yMjQtMTYuNTEgMjEuNzc0em0xNi41NDYtMTMuMzI1YzUuMzI0IDAgNC4zNDIgNS45ODQgNC4zNDIgNi40NjloLTEwLjQ3NGMwLS42Mi45ODktNi40NyA2LjEzMi02LjQ3ek0xOTkuMjQ2IDExNS45MTdsMS42ODktMTAuMjg0cy00LjYzMiAyLjMyLTcuODA3IDIuMzJjLTYuNjkzIDAtOS4zNzgtNS4xMS05LjM3OC0xMC42IDAtMTEuMTM3IDUuNzU4LTE3LjI2NSAxMi4xNjgtMTcuMjY1IDQuODA4IDAgOC42NjUgMi42OTkgOC42NjUgMi42OTlsMS41NC05Ljk5M3MtNC41NTQtMy4yOS05LjQ1Ni0zLjMwOGMtMTQuNzQ1LS4wNTgtMjMuMTgyIDEwLjIwOC0yMy4xODIgMjcuOTU1IDAgMTEuNzYzIDYuMjQ4IDE5Ljc2OCAxNy41MDYgMTkuNzY4IDMuMTgzIDAgOC4yNTUtMS4yOTIgOC4yNTUtMS4yOTJ6TTY4LjA4NiA3OS4wMDZjLTYuNDcgMC0xMS40MjcgMi4wNzktMTEuNDI3IDIuMDc5bC0xLjM3IDguMTI3czQuMDkzLTEuNjYzIDEwLjI4LTEuNjYzYzMuNTE0IDAgNi4wODQuMzk1IDYuMDg0IDMuMjUgMCAxLjczNC0uMzE0IDIuMzc0LS4zMTQgMi4zNzRzLTIuNzcyLS4yMzEtNC4wNTYtLjIzMWMtOS4yMSAwLTE2LjcyOSAzLjQ4Mi0xNi43MjkgMTMuOTggMCA4LjI3MyA1LjYyMyAxMC4xNyA5LjEwOCAxMC4xNyA2LjY1NyAwIDkuMjkyLTQuMjAzIDkuNDQ0LTQuMjE1bC0uMDc3IDMuNDg4aDguMzA3bDMuNzA2LTI1Ljk4YzAtMTEuMDI1LTkuNjE2LTExLjM4LTEyLjk1Ni0xMS4zOHptMS40MzggMjEuMDk2Yy4xOCAxLjU4Ni0uNDEgOS4wODYtNi4wOTIgOS4wODYtMi45MyAwLTMuNjkxLTIuMjQtMy42OTEtMy41NjIgMC0yLjU4NCAxLjQwMy01LjY4MyA4LjMxNS01LjY4MyAxLjYxIDAgMS4xOTcuMTE2IDEuNDY4LjE1OXpNODkuODcgMTE2LjljMi4xMjYgMCAxNC4yNzMuNTQgMTQuMjczLTExLjk5NCAwLTExLjcyMS0xMS4yNDQtOS40MDQtMTEuMjQ0LTE0LjExNCAwLTIuMzQyIDEuODMzLTMuMDggNS4xODQtMy4wOCAxLjMyOSAwIDYuNDQ3LjQyMyA2LjQ0Ny40MjNsMS4xODktOC4zM3MtMy4zMTItLjc0MS04LjcwNC0uNzQxYy02Ljk4IDAtMTQuMDYzIDIuNzg2LTE0LjA2MyAxMi4zMTggMCAxMC44MDIgMTEuODEyIDkuNzE3IDExLjgxMiAxNC4yNjcgMCAzLjAzNy0zLjMgMy4yODctNS44NDQgMy4yODctNC40MDEgMC04LjM2My0xLjUxMS04LjM3Ny0xLjQzOGwtMS4yNiA4LjI0NWMuMjMuMDcgMi42NzUgMS4xNTcgMTAuNTg4IDEuMTU3ek0yNzcuMDYzIDcxLjQ0OWwtMS43MDUgMTIuNzA5cy0zLjU1My00LjkwNS05LjExMi00LjkwNWMtMTAuNDU5IDAtMTUuODQ5IDEwLjQyMy0xNS44NDkgMjIuMzk2IDAgNy43MyAzLjg0NCAxNS4zMDcgMTEuNjk5IDE1LjMwNyA1LjY1MSAwIDguNzg0LTMuOTQxIDguNzg0LTMuOTQxbC0uNDE1IDMuMzY1aDkuMTc4bDcuMjA3LTQ0Ljg2Mi05Ljc4Ny0uMDd6bS00LjA1MiAyNC43YzAgNC45ODQtMi40NjggMTEuNjQtNy41ODEgMTEuNjQtMy4zOTYgMC00Ljk4OC0yLjg1LTQuOTg4LTcuMzIzIDAtNy4zMTUgMy4yODUtMTIuMTQgNy40MzItMTIuMTQgMy4zOTQgMCA1LjEzNyAyLjMzIDUuMTM3IDcuODI0ek0xNy4wMDUgMTE2LjQxN2w1Ljc0My0zMy44Ny44NDQgMzMuODdoNi40OTlsMTIuMTI1LTMzLjg3LTUuMzcxIDMzLjg3aDkuNjU4bDcuNDM3LTQ0LjkyMi0xNS4zNDItLjExNy05LjEyNiAyNy41MDQtLjI1LTI3LjM4N2gtMTQuMDZsLTcuNTQ0IDQ0LjkyMmg5LjM4N3oiIGZpbGw9IiMwMDYiLz48cGF0aCBkPSJNMTYyLjM1NyAxMTYuNDhjMi43NDYtMTUuNjE0IDMuNzI0LTI3Ljk0NiAxMS43MzItMjUuMzkyIDEuMTUtNi4wNDQgMy44OTEtMTEuMyA1LjE0My0xMy44NTggMCAwLS4zOTYtLjU5LTIuODcxLS41OS00LjIyNSAwLTkuODY2IDguNTc1LTkuODY2IDguNTc1bC44NDMtNS4zMDFoLTguNzg2bC01Ljg4NCAzNi41NjZoOS42ODl6TTIxOS4wMDYgNzkuMDA2Yy02LjQ3MiAwLTExLjQzIDIuMDc5LTExLjQzIDIuMDc5bC0xLjM2OSA4LjEyN3M0LjA5NS0xLjY2MyAxMC4yOC0xLjY2M2MzLjUxNCAwIDYuMDgzLjM5NSA2LjA4MyAzLjI1IDAgMS43MzQtLjMxMyAyLjM3NC0uMzEzIDIuMzc0cy0yLjc3LS4yMzEtNC4wNTUtLjIzMWMtOS4yMSAwLTE2LjcyOSAzLjQ4Mi0xNi43MjkgMTMuOTggMCA4LjI3MyA1LjYyMiAxMC4xNyA5LjEwNyAxMC4xNyA2LjY1NSAwIDkuMjkyLTQuMjAzIDkuNDQzLTQuMjE1bC0uMDc4IDMuNDg4aDguMzFsMy43MDQtMjUuOThjLjAwMS0xMS4wMjUtOS42MTUtMTEuMzgtMTIuOTUzLTExLjM4em0xLjQzNiAyMS4wOTZjLjE4IDEuNTg2LS40MTEgOS4wODYtNi4wOTIgOS4wODYtMi45MzIgMC0zLjY5Mi0yLjI0LTMuNjkyLTMuNTYyIDAtMi41ODQgMS40MDItNS42ODMgOC4zMTUtNS42ODMgMS42MTEgMCAxLjE5OS4xMTYgMS40NjkuMTU5ek0yNDEuNTIyIDExNi40OGMxLjUwOC0xMS40ODcgNC4yOTktMjcuNjE1IDExLjczMS0yNS4zOTIgMS4xNDktNi4wNDQuMDQxLTYuMDI4LTIuNDMzLTYuMDI4LTQuMjI4IDAtNS4xNjQuMTU0LTUuMTY0LjE1NGwuODQ0LTUuMzAxaC04Ljc4NWwtNS44ODQgMzYuNTY3aDkuNjl6IiBmaWxsPSIjMDA2Ii8+PGc+PHBhdGggZD0iTTEyMi40MzQgMTEzLjA1OWwxLjE4MS04LjAxOWMtLjY0NSAwLTEuNTk0LjI3Ni0yLjQzMS4yNzYtMy4yODQgMC0zLjY0Ni0xLjc0Ni0zLjQzNy0zLjAzN2wyLjY1My0xNi4zNjJoNC45OTFsMS4yMDUtOC44N2gtNC43MDZsLjk1OC01LjUxNmgtOS40MzRjLS4yMDguMjA4LTUuNTY5IDMxLjAyMy01LjU2OSAzNC43NzUgMCA1LjU1NSAzLjExOSA4LjAyOSA3LjUxNyA3Ljk4OSAzLjQ0NC0uMDI5IDYuMTI2LS45ODIgNy4wNzItMS4yMzZ6TTEyNS40MjMgOTcuNzdjMCAxMy4zMzIgOC44IDE2LjUgMTYuMjk3IDE2LjUgNi45MiAwIDkuOTY1LTEuNTQ3IDkuOTY1LTEuNTQ3bDEuNjYyLTkuMDk5cy01LjI2NCAyLjMxOS0xMC4wMTggMi4zMTljLTEwLjEzIDAtOC4zNTYtNy41NTMtOC4zNTYtNy41NTNoMTkuMTcyczEuMjM4LTYuMTEzIDEuMjM4LTguNjA0YzAtNi4yMTYtMy4wOTQtMTMuNzktMTMuNDUyLTEzLjc5LTkuNDg2LjAwMi0xNi41MDggMTAuMjIzLTE2LjUwOCAyMS43NzR6bTE2LjU0NC0xMy4zMjVjNS4zMjQgMCA0LjM0MiA1Ljk4MyA0LjM0MiA2LjQ2N2gtMTAuNDc0YzAtLjYxOC45OS02LjQ2NyA2LjEzMi02LjQ2N3pNMjAxLjcwNyAxMTMuMDU1bDEuNjg4LTEwLjI4NXMtNC42MjkgMi4zMjEtNy44MDYgMi4zMjFjLTYuNjkyIDAtOS4zNzYtNS4xMS05LjM3Ni0xMC42IDAtMTEuMTM3IDUuNzU4LTE3LjI2NCAxMi4xNjgtMTcuMjY0IDQuODA3IDAgOC42NjUgMi42OTkgOC42NjUgMi42OTlsMS41NC05Ljk5M3MtNS43MjEtMi4zMTUtMTAuNjI1LTIuMzE1Yy0xMC44OTEgMC0yMS40ODYgOS40NDgtMjEuNDg2IDI3LjE5MiAwIDExLjc2NiA1LjcyMSAxOS41MzcgMTYuOTc5IDE5LjUzNyAzLjE4My4wMDEgOC4yNTMtMS4yOTIgOC4yNTMtMS4yOTJ6TTcwLjU0NyA3Ni4xNDNjLTYuNDY5IDAtMTEuNDI4IDIuMDc5LTExLjQyOCAyLjA3OWwtMS4zNjkgOC4xMjdzNC4wOTMtMS42NjMgMTAuMjgtMS42NjNjMy41MTMgMCA2LjA4My4zOTUgNi4wODMgMy4yNSAwIDEuNzM0LS4zMTUgMi4zNzQtLjMxNSAyLjM3NHMtMi43NzEtLjIzMi00LjA1NC0uMjMyYy04LjE1OSAwLTE2LjczIDMuNDgyLTE2LjczIDEzLjk4IDAgOC4yNzIgNS42MjMgMTAuMTcgOS4xMDggMTAuMTcgNi42NTYgMCA5LjUyNS00LjMxOSA5LjY3OC00LjMzMmwtLjMxMSAzLjYwNWg4LjMwN2wzLjcwNi0yNS45ODFjMC0xMS4wMjItOS42MTUtMTEuMzc3LTEyLjk1NS0xMS4zNzd6bTIuMDIxIDIxLjE1NGMuMTggMS41ODctLjk5NSA5LjAyNi02LjY3NSA5LjAyNi0yLjkzIDAtMy42OTItMi4yMzgtMy42OTItMy41NjIgMC0yLjU4MiAxLjQwMy01LjY4MiA4LjMxNi01LjY4MiAxLjYwOC4wMDIgMS43OC4xNzQgMi4wNTEuMjE4ek05Mi4zMzEgMTE0LjAzOGMyLjEyNSAwIDE0LjI3My41NCAxNC4yNzMtMTEuOTk1IDAtMTEuNzE5LTExLjI0NS05LjQwNC0xMS4yNDUtMTQuMTEyIDAtMi4zNDQgMS44MzMtMy4wODIgNS4xODMtMy4wODIgMS4zMyAwIDYuNDQ3LjQyMyA2LjQ0Ny40MjNsMS4xOS04LjMzYzAgLjAwMS0zLjMxMi0uNzQxLTguNzA0LS43NDEtNi45NzkgMC0xNC4wNjMgMi43ODYtMTQuMDYzIDEyLjMxOCAwIDEwLjgwMSAxMS44MTIgOS43MTcgMTEuODEyIDE0LjI2NyAwIDMuMDM3LTMuMyAzLjI4NC01Ljg0MyAzLjI4NC00LjQwMSAwLTguMzY0LTEuNTEtOC4zNzgtMS40MzhsLTEuMjU4IDguMjQ2Yy4yMjguMDcgMi42NzIgMS4xNiAxMC41ODYgMS4xNnpNMjc5Ljg1MiA2OC42NjhsLTIuMDM1IDEyLjYyN3MtMy41NTEtNC45MDUtOS4xMS00LjkwNWMtOC42NDQgMC0xNS44NDkgMTAuNDIyLTE1Ljg0OSAyMi4zOTcgMCA3LjczIDMuODQzIDE1LjMwNCAxMS42OTkgMTUuMzA0IDUuNjUxIDAgOC43ODQtMy45NCA4Ljc4NC0zLjk0bC0uNDE1IDMuMzY1aDkuMTc2bDcuMjA3LTQ0Ljg2My05LjQ1Ny4wMTV6bS00LjM4MSAyNC42MmMwIDQuOTgzLTIuNDY3IDExLjYzOS03LjU4MiAxMS42MzktMy4zOTUgMC00Ljk4Ni0yLjg1LTQuOTg2LTcuMzIzIDAtNy4zMTQgMy4yODUtMTIuMTQgNy40My0xMi4xNCAzLjM5Ni0uMDAxIDUuMTM4IDIuMzMyIDUuMTM4IDcuODI0ek0xOS40NjYgMTEzLjU1NWw1Ljc0My0zMy44Ny44NDMgMzMuODdoNi41bDEyLjEyNS0zMy44Ny01LjM3MSAzMy44N2g5LjY1OGw3LjQzOC00NC45MjNINDEuNDY3bC05LjMwMSAyNy41NjMtLjQ4NC0yNy41NjNIMTcuOTE1bC03LjU0NSA0NC45MjNoOS4wOTZ6TTE2NC44MTggMTEzLjYxN2MyLjc0Ni0xNS42MTYgMy4yNTUtMjguMjk2IDkuODA4LTI1Ljk3NSAxLjE0Ny02LjA0NCAyLjI1NC04LjM4MiAzLjUwNi0xMC45NCAwIDAtLjU4Ny0uMTIzLTEuODE5LS4xMjMtNC4yMjUgMC03LjM1NSA1Ljc3Mi03LjM1NSA1Ljc3MmwuODQxLTUuMzAxaC04Ljc4NGwtNS44ODUgMzYuNTY3aDkuNjg4ek0yMjMuNDc1IDc2LjE0M2MtNi40NjkgMC0xMS40MjggMi4wNzktMTEuNDI4IDIuMDc5bC0xLjM2OCA4LjEyN3M0LjA5My0xLjY2MyAxMC4yOC0xLjY2M2MzLjUxMyAwIDYuMDgxLjM5NSA2LjA4MSAzLjI1IDAgMS43MzQtLjMxMyAyLjM3NC0uMzEzIDIuMzc0cy0yLjc3LS4yMzItNC4wNTUtLjIzMmMtOC4xNTggMC0xNi43MjkgMy40ODItMTYuNzI5IDEzLjk4IDAgOC4yNzIgNS42MjIgMTAuMTcgOS4xMDcgMTAuMTcgNi42NTYgMCA5LjUyNS00LjMxOSA5LjY3Ny00LjMzMmwtLjMwOSAzLjYwNWg4LjMwN2wzLjcwNS0yNS45ODFjLjAwMS0xMS4wMjItOS42MTUtMTEuMzc3LTEyLjk1NS0xMS4zNzd6bTIuMDI0IDIxLjE1NGMuMTggMS41ODctLjk5NiA5LjAyNi02LjY3OCA5LjAyNi0yLjkzIDAtMy42OS0yLjIzOC0zLjY5LTMuNTYyIDAtMi41ODIgMS40MDMtNS42ODIgOC4zMTUtNS42ODIgMS42MDguMDAyIDEuNzguMTc0IDIuMDUzLjIxOHpNMjQ0LjAyMyAxMTMuNjE3YzIuNzQ3LTE1LjYxNiAzLjI1Ni0yOC4yOTYgOS44MDctMjUuOTc1IDEuMTQ5LTYuMDQ0IDIuMjU3LTguMzgyIDMuNTA4LTEwLjk0IDAgMC0uNTg3LS4xMjMtMS44Mi0uMTIzLTQuMjI0IDAtNy4zNTQgNS43NzItNy4zNTQgNS43NzJsLjg0LTUuMzAxaC04Ljc4M2wtNS44ODUgMzYuNTY3aDkuNjg3ek0yODkuMTA1IDEwNy45NzVjLjQ3OSAwIC45NTEuMTIzIDEuNDA2LjM3My40NTkuMjQyLjgxNi41OTggMS4wNzIgMS4wNTkuMjU3LjQ1OC4zODMuOTM1LjM4MyAxLjQzNCAwIC40OTMtLjEyNi45NjktLjM3OSAxLjQyNGEyLjY1NSAyLjY1NSAwIDAgMS0xLjA1OSAxLjA2M2MtLjQ1NC4yNS0uOTMuMzc2LTEuNDI0LjM3Ni0uNDk4IDAtLjk3NC0uMTI2LTEuNDI5LS4zNzZhMi42NzggMi42NzggMCAwIDEtMS4wNTgtMS4wNjMgMi44NjUgMi44NjUgMCAwIDEtLjM4MS0xLjQyNGMwLS40OTkuMTI3LS45NzYuMzg0LTEuNDM0YTIuNjMgMi42MyAwIDAgMSAxLjA3My0xLjA1OWMuNDYxLS4yNS45MzMtLjM3MyAxLjQxMi0uMzczbTAgLjQ3MmMtLjQwMSAwLS43OTMuMTA0LTEuMTc2LjMxM2EyLjE4MyAyLjE4MyAwIDAgMC0uODk0Ljg4NWMtLjIxNC4zODEtLjMyMi43OC0uMzIyIDEuMTk0cy4xMDQuODEuMzEzIDEuMTg4Yy4yMTMuMzc3LjUwOS42NzMuODkxLjg4Ni4zNzguMjA4Ljc3My4zMTMgMS4xODguMzEzLjQxMiAwIC44MS0uMTA1IDEuMTg4LS4zMTMuMzc4LS4yMTMuNjc0LS41MDkuODg0LS44ODYuMjExLS4zODEuMzE0LS43NzQuMzE0LTEuMTg4cy0uMTA3LS44MTMtLjMyMS0xLjE5NGEyLjE2IDIuMTYgMCAwIDAtLjg5NC0uODg1IDIuNDA4IDIuNDA4IDAgMCAwLTEuMTcxLS4zMTNtLTEuMjU1IDMuOTc2di0zLjA4M2gxLjA2MWMuMzYxIDAgLjYyNS4wMjkuNzg1LjA4OGEuNzU2Ljc1NiAwIDAgMSAuMzg4LjI5Ny43ODQuNzg0IDAgMCAxIC4xNDYuNDUxLjgxNy44MTcgMCAwIDEtLjI0NC41ODguOTM0LjkzNCAwIDAgMS0uNjM3LjI4Ljk0Ni45NDYgMCAwIDEgLjI2Mi4xNjNjLjEyMy4xMjIuMjc1LjMyNi40NTUuNjExbC4zNzcuNjA0aC0uNjA5bC0uMjcxLS40ODVjLS4yMTYtLjM4My0uMzg5LS42MjEtLjUyMS0uNzE4LS4wOTEtLjA3MS0uMjI0LS4xMDYtLjM5OS0uMTA2aC0uMjkxdjEuMzExbC0uNTAyLS4wMDFtLjQ5OC0xLjczNWguNjA0Yy4yODkgMCAuNDg0LS4wNDMuNTg4LS4xMjlhLjQxOC40MTggMCAwIDAgLjE2LS4zNDIuNDA0LjQwNCAwIDAgMC0uMDc1LS4yNDIuNDU4LjQ1OCAwIDAgMC0uMjEzLS4xNjRjLS4wOTEtLjAzNS0uMjU0LS4wNTMtLjQ5OC0uMDUzaC0uNTY1di45MyIgZmlsbD0iI2ZmZiIvPjwvZz48L2c+PC9zdmc+), url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEiIHdpZHRoPSI2MCIgaGVpZ2h0PSIxOCIgdmlld0JveD0iMCAwIDg4LjA0ODcgMjYuOTk1OSIgaWQ9InN2ZzIiPjxkZWZzIGlkPSJkZWZzNCI+PHN0eWxlIGlkPSJzdHlsZTYiLz48L2RlZnM+PGcgaWQ9Imc1MDg4Ij48cGF0aCBpZD0icG9seWdvbjEwIiBmaWxsPSIjMDA0Njg2IiBkPSJNMzEuMDE4IDI2LjYwOEwzNS40NzUuNDU0aDcuMTNsLTQuNDYgMjYuMTU0aC03LjEyN3oiLz48cGF0aCBkPSJNNjMuOTk5IDEuMDk4QzYyLjU4Ni41NjggNjAuMzczIDAgNTcuNjA5IDBjLTcuMDQzIDAtMTIuMDA1IDMuNTQ3LTEyLjA0NyA4LjYzLS4wNCAzLjc1OSAzLjU0MiA1Ljg1NSA2LjI0NiA3LjEwNiAyLjc3NSAxLjI4MSAzLjcwOCAyLjEgMy42OTQgMy4yNDQtLjAxNyAxLjc1My0yLjIxNSAyLjU1NC00LjI2NCAyLjU1NC0yLjg1NCAwLTQuMzctLjM5Ni02LjcxLTEuMzcybC0uOTItLjQxNy0xIDUuODU1YzEuNjY2LjczIDQuNzQ0IDEuMzYzIDcuOTQxIDEuMzk2IDcuNDk0IDAgMTIuMzU4LTMuNTA3IDEyLjQxMy04LjkzNS4wMjctMi45NzYtMS44NzItNS4yNC01Ljk4NC03LjEwNi0yLjQ5Mi0xLjIxLTQuMDE4LTIuMDE3LTQuMDAyLTMuMjQyIDAtMS4wODggMS4yOTItMi4yNSA0LjA4Mi0yLjI1IDIuMzMyLS4wMzcgNC4wMi40NzIgNS4zMzYgMS4wMDJsLjYzOS4zMDEuOTY2LTUuNjY4eiIgaWQ9InBhdGgxMiIgZmlsbD0iIzAwNDY4NiIvPjxwYXRoIGQ9Ik04Mi4yNzkuNDc4SDc2Ljc3Yy0xLjcwNiAwLTIuOTgzLjQ2Ny0zLjczMyAyLjE3TDYyLjQ1IDI2LjYxNmg3LjQ4NnMxLjIyNC0zLjIyMyAxLjUtMy45M2MuODIgMCA4LjA5LjAxMSA5LjEzLjAxMS4yMTQuOTE2Ljg2OCAzLjkyLjg2OCAzLjkybDYuNjE1LS4wMDFMODIuMjc5LjQ3OG0tOC43OSAxNi44NThjLjU4OS0xLjUwNyAyLjg0LTcuMzEgMi44NC03LjMxLS4wNDIuMDY5LjU4NC0xLjUxNS45NDUtMi40OTZsLjQ4MiAyLjI1NCAxLjY1IDcuNTUzaC01LjkxOHoiIGlkPSJwYXRoMTQiIGZpbGw9IiMwMDQ2ODYiLz48cGF0aCBkPSJNMjUuMDQuNDczbC02Ljk4IDE3LjgzNS0uNzQzLTMuNjI0Yy0xLjMtNC4xNzktNS4zNDgtOC43MDUtOS44NzMtMTAuOTcxbDYuMzgxIDIyLjg3MiA3LjU0My0uMDA5TDMyLjU5LjQ3M0gyNS4wNHoiIGlkPSJwYXRoMTYiIGZpbGw9IiMwMDQ2ODYiLz48cGF0aCBkPSJNMTEuNTg2LjQ1N0guMDkxTDAgMS4wMDFjOC45NDMgMi4xNjUgMTQuODYgNy4zOTcgMTcuMzE3IDEzLjY4M2wtMi41LTEyLjAxOUMxNC4zODYgMS4wMSAxMy4xMzQuNTE1IDExLjU4Ni40NTd6IiBpZD0icGF0aDE4IiBmaWxsPSIjZWY5YjExIi8+PC9nPjwvc3ZnPg==);
}

</style>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   BIKE POINT </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Bike</a></li>
               <li> <a href="enterdriver.php"> Add Accessory</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="returncar.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Client</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
 $id = $_GET["id"];
 $sql1 = "SELECT c.bike_name, c.bike_nameplate, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.charge_type
 FROM rentedbikes rc, bikes c where id = '$id' AND c.bike_id = rc.bike_id";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $bike_name = $row["bike_name"];
        $bike_nameplate = $row["bike_nameplate"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $charge_type = $row["charge_type"];
        $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
    }
}
?>
    <div class="container" style="margin-top: 65px;width:100%;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;width:100%;">
      <div class="form-area" style="width:100%;">
        <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Journey Details </h3>
          <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Allow your driver to fill the below form </h6>

           <h5> Vehicle:&nbsp;  <?php echo($bike_name);?></h5>

           <h5> Vehicle Number:&nbsp;  <?php echo($bike_nameplate);?></h5>

           <h5> Rent date:&nbsp;  <?php echo($rent_start_date);?></h5>

           <h5> End Date:&nbsp;  <?php echo($rent_end_date);?></h5>

           <h5> Fare:&nbsp;  ₹<?php 
            if($charge_type == "days"){
                    echo ($fare . "/day");
                } else {
                    echo ($fare . "/km");
                }
            ?>
            </h5>
          <?php if($charge_type == "km") { ?>
          <div class="form-group">
            <input type="text" class="form-control" id="distance_or_days" name="distance_or_days" placeholder="Enter the distance travelled (in km)" required="" autofocus>
          </div>
          <?php }  else { ?>
            <h5> Number of Day(s):&nbsp;  <?php echo($no_of_days);?></h5>
            <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
          <?php } ?>
          <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">
		  <script>
			function thru_cash(){
				document.getElementById('page').style="display:none;";
				document.getElementById('card_hol').required=false;
				document.getElementById('card_num').required=false;
				document.getElementById('card_mm').required=false;
				document.getElementById('card_yy').required=false;
				document.getElementById('card_cvv').required=false;
			}
			
			function thru_card(){
				document.getElementById('page').style="display:block;";
				document.getElementById('card_hol').required=true;
				document.getElementById('card_num').required=true;
				document.getElementById('card_mm').required=true;
				document.getElementById('card_yy').required=true;
				document.getElementById('card_cvv').required=true;
			}
		  </script>
		  <input type="radio" name="paymentmode" value="CS" onclick="thru_cash()" checked> Cash
		  <input type="radio" name="paymentmode" value="CR" onclick="thru_card()"> Card
		  <div id="page">
  <div class="page__demo">
    <div class="payment-card">
      <div class="payment-card__front">
        <div class="payment-card__group">
          <label class="payment-card__field">
            <span class="payment-card__hint">Holder of card</span>
            <input class="payment-card__input" placeholder="Holder of card" pattern="[A-Za-z, ]{2,}" name="holder-card" id="card_hol">
          </label>
        </div>
        <div class="payment-card__group">
          <label class="payment-card__field">
            <span class="payment-card__hint">Number of card</span>
            <input type="text" class="payment-card__input" placeholder="Number of card" maxlength="16" pattern="[0-9]{16}" name="number-card" id="card_num">
          </label>
        </div>
        <div class="payment-card__group">
          <span class="payment-card__caption">valid thru</span>
        </div>
        <div class="payment-card__group payment-card__footer">
          <label class="payment-card__field payment-card__month">
            <span class="payment-card__hint">Month</span>
            <input type="text" class="payment-card__input" placeholder="MM" maxlength="2" pattern="[0-9]{2}" name="mm-card" id = "card_mm">
          </label>
          <span class="payment-card__separator">/</span>
          <label class="payment-card__field payment-card__year">
            <span class="payment-card__hint">Year</span>
            <input type="text" class="payment-card__input" placeholder="YY" maxlength="2" pattern="[0-9]{2}" name="year-card" id="card_yy">
          </label>
        </div>
      </div>
      <div class="payment-card__back">
        <div class="payment-card__group">
          <label class="payment-card__field payment-card__cvc">
            <span class="payment-card__hint">CVC</span>
            <input type="text" class="payment-card__input" placeholder="CVC" maxlength="3" pattern="[0-9]{3}" name="cvc-card" id="card_cvv">
          </label>
        </div>
      </div>
      </div>
    <button class="payment-card__button" hidden>Send</button>
    </div>
</div>
           <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">    
        </form>
      </div>
    </div>
   
    </div>

</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© 2019 Bike Point</h5>
                </div>
            </div>
        </div>
    </footer>
</html>