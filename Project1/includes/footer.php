

</div>
<footer>
    <p> 2023 &#169; All rights reserved. - Emirates Hospital</p>
</footer>
<script>
document.querySelectorAll(".nav-item").forEach((ele) =>
  ele.addEventListener("click", function (event) {

    document
      .querySelectorAll(".nav-item")
      .forEach((ele) => ele.classList.remove("active"));
    this.classList.add("active")
  })
);
</script>
<!-- <script src="../js/index.js"></script> -->
</body>
</html>
