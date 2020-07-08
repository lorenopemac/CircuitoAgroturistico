<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'My Yii Application';

?>
<style>

.header {
  padding: 60px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 30px;
  width:100%;
  overflow:visible;
}
.div {border-color: coral;}

</style>

<div class="header">
  <h1>Bienvenido</h1>
</div> 
<aside class="control-sidebar control-sidebar-dark">
<div class="site-index" >

    

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
            <p><h2>34° Feria de Artesanos</h2></p>
                
                <p><?php echo Html::img('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUSExMVFhUWGCEaGBgXGBsaHxodHhsdHB8gHR4bHyggIB0lIB0fITEjJSkrLi4uGiAzODMtNygtLisBCgoKDg0OGxAQGy0lICYtLS0tLy0wLS0tLS0tLS0tLS8tMi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKoBKQMBIgACEQEDEQH/xAAcAAACAwEBAQEAAAAAAAAAAAAEBQIDBgcBAAj/xABDEAACAQIEAwYCCAQFAwMFAAABAhEDIQAEEjEFQVEGEyIyYXGBkRQjQqGxwdHwB1Jy4TNikrLxFVOCFiRzVGOUotL/xAAaAQADAQEBAQAAAAAAAAAAAAABAgMABAUG/8QALxEAAgICAQMCBAUEAwAAAAAAAAECEQMhEgQxQRNRImFxoYGxwdHwBTJCkRSS4f/aAAwDAQACEQMRAD8A4/GI1qZUwcXMuLc5lmAVywbWPiItB+EYWxmgCMfRizRj3u8EUpOPgMXd0ZxLRGMYHIx5i2MROMAiFx8RiWPiMYJGMeMMSjHr7DGMVxj0YsWnPLEkokzAJgSfQSBJ6XIHxxgFWnEguLAn9hi7L0DNwd4+O8fccYJPhlcoWMC4i/vy9cEFCwgbbnBeU4Y1ViKem17gjkDY3vuMajg/DFp0mLsqkjSwYJETcCdiYsRB6c8CrC9CleyT/RqeZ1IVckBdXiEbkiPKPfmOuGNLh9ChTU04q1TvqHh5HY9bWF8XZ7i1MqKdMEFfI1hE3IAIgj0Nr/ErkzVSgjuGDMw7shhMK4MwJs1txtiUW1ps6Y9PJrk1XyZYMwUdFCI9704OkbAW80TeOZxr/p1PKZU0pbvKg1M5GnVBkGRY/wAujl1sJyXZXI1n15oIaiUmBNzM3MwPMqxfeJB64acb4gcwNDrAGrSRckRIjkDaOse0YNtM6JR5yTS0vmR7TZajqUUHLEpNTUV84F4g7W3PPGVqVFIZSQJP8u2/MbDrG+NNxHJV/o+vSpogkq/d3ZtFkLdPQ2n3Jxmc2pjXpQIx5TIMHnvBnf5Rii+Z5thnBmqBj3S1CxEeE7CwvaIIGk32JxoKuSfMtTp1Mr3L6NPhpM2oAR3hVVOokkXURaZvhX2a7X18nLUAmqoNJGgACI2vG3P398Xv23zzVzVLBq6oQpKjwr5yABbYRO+DLtoMXRm+IcGem5puhR1F0YEHbVF/Qzflj3I5IFh4NZ7qp4fdHAM9QSIjmBGGtPi+rM97mD30kB/GfFNiusREi3PaMO+L1cpTf/26OisI0021BusM4DESeY3BjHSsD9Pn4NGHqZOKZgM5TYiSL8wYBE7W6YEfLt/LjTvlPpLaaauajEQCZnbEq/ZjNc6JECLkY59dxp4nGXFbMmMubdScGZ3KlXKEX/fTDY8Kq0nTvUKSfCTBG45g/GJwNxnLd3VAF7Am0c8LdoR2nTE1VYEYt4afrNP8yuPmjYhUEnF/DF+tT3j5gjBQBfqx9OJKtsW0MuWIUC5+A+PoMExXSpsxge99gOp9MT7lP+6P9DYvr1FA7tPLzb+cjn7DkMC6RjGDyMFuNVL2/L+0YojE6GYIBURvIP79sIiwAovthrkMnqIFsLVQ4b5DMBGGox9+Hol5NJmv4f5paHftS0oBM6l5/GcZTMZHTcifux1Zv4jIMi2X0SyxTmfs3vHW2OXcSzBeYgLP7vvibvwEUMgkgcvbFMiYxead74+RFm+GFPqi2ECOs7z+mIFR0vz98Xu2KlpE7fv++AglUjbE4FsO+y+TpPWIrMEpqrMdRIkqJAsyz7TJ2E4jmamWVqiCitTcK5eoCJ2aFaCR0M+uMpXKh+Hw8hh2E7gZpRXoLXpsGEFtIESS3WwBMG+KuIdzU8SWo63KBQAVUt4QRJPUwSeXLCvKqfDUpHSQ1wNxAuQT6TaeeGPAFpJWUVFY0ww71T4THS9trjngpW9ivS0KEpeJZmJGwnnjQ8I4UxZaj6TSOoxvZRMkdJgW6dNzTkaNfNv3AKUCZQNsB/mPvy9Rhzlc5Tooq1Co+1GpSdzpKiZ+W9xgSaRlCV1WwWsadOXpsQSFbSIFtWwkWJ6CY07DCTN5h67gVLdAvlX2j88S4gRVc1EOmY8MyLDeORJkkC0nEKw0IVbzC599wL8/74m5Hq9N06xpOXc8q1hSRlm0i8X9h6TeOdsCZPLtWqCby3lF+ZMbi+5J5YHrVu9OqPYfmfXljQcIz1HL0CxYitebbC/PSQZtYRtHvooHUydXFHReF1RlaGgBAaa2Y+EMLwSd7m08jaNsZCmy1cyoYimWYuVKwljO3IaiDAO04bdos0qUVSp4mqQ1NmsCDckECAeXW8ERjInOlaqLGpWRk0ncEwTcG1hyxR6OfB8OGT8vQ6zfFmo0qeXNQMq1m1DQyq5U6r6oMHSbx9q+2M1mCHupCtKmC0BhqEAzEaT6mZ+OA6tRWK6g2qAAT4pNot1P2pve+A6mZU6pB0wQsxM9SNvf2GHtPwcVUTNPwsSdKwGB6klRp94Mxvgh86HeQoALXuTI3gRz5cth74W61giCWB3k7X5euI0rgwfe20/8YJrGVfMANpB8AeQBBJOwJYgEnxew+GCuKvJpljASkA3X/EqExyJiLYTmVIZYBFwIm4JjcQf3bHuczbE+KAYAsRFvznFI5HVWBadmt4IgSvUalUYPT8hC6SzTEAFh4mOw6xjpVftZSQLlKrLUeEEqp1KDcsxYgaoBkXPPHC6OfqpUDzDSGJ3BIuCRzvfEaNV5VmZhp2Mkm9zf8et8Tasbk7vydayHaHLVKddqppoBq00j4i4EQDYLJm0iMc/49xunX1KmWC9HDEH4rBU/P5YFoZ8aaa90KjF7mSA8mQrR18V94jpjpvYxMlXpGqcrQarScrqMqjLM3sQ2lZiQSdI9YXgvBp58jXxM401HkAB7nFvD6f1yf1DH6Bz3ZLheb1mkEp1YLfV+CYMatGxBa0wJ64yFH+H8gstdJVVqKug3DlgoBt4jEwJ5dcDdjKMWrb+xyIKNsE1FKLpG7eY+nJfzONrxPspSy9TR9JVjN2SmTpOkx9q8z5fQzcRjFtVYQd+oO49/XDSTSJtewN9HJ3OPPo+LxWtJEegxT9LH8v34TYNhGXvGCny5sQLfhieUpAXw2yMeU+4/PGPUxYVx2IKtIgx8d8eGiRe5POxgfHGuTg/eSVS3Nth/q2+GC8nwYEMqB6zlSO7SVBEc2I1fcPfB34ObLh4u7MfRRjqEGGTV/pgz9xGIJk3K6osdt73Ity3BHuMaTieRIAqMAqagukb3gGbyPN8Z+efoV6qiQdIpkbHZgZ/Hn6YzTojHinsoznC3plQwALCVgyNytz7jFJybrBKtBE+4Ji1ueDc1mJgktrHmLNJJ80i0AX6k9cU1C94IfSNUmfEBaRPTVtjbFpEaHD9bKoMM24YbGY3E2ki564rdFVoAYMp6xMc/+D0x93t9QnaehnmbGSDj6vVcwQSJv0HQx8gMYNKibVXJjdjcm88zuenX3xXRYLuqmRzvAPx3/DElyzEqCILCxa339eWH/Dh3FSlWNKi605bu6wADkeGGtc6vEAeYGMBi+jlRpaHiRqJ6AgXj1GoX9MeF+9qADYkKCd7eEEwLn/jDfjmbVqtX6ummseWkDoW62UewOE9N9NxuNjt8sI5eDo6XGnJyZvuA0UQgCdjJ6R+/wx92mo5c0Sxu5OlAB9olSWU8hHmGxJFpAxmeC5xtWt3cnyq2o+HrHMfDF/EsvUY69bVPUksR88SlljdFsfSS5qTkArko8rGevL4jCTjucJqMvQ398PKGYIYSPjEcsZTNXqsDzcz88PCmdHVyajS8jiipVFsCdItfGt4RkqNKmmbcd8NSrpnSqMRfUTNwZ5WBsCYJzupd40xyv+mLaPEH0EJUdb+QMQOd4Bj9Z98PB/FdA6mCWOuVfqdLo1xn6Fei6qGo0lckE2Y6oBBEggKCTzDCwmBgcxku7ArKJZDKg3HtsItI+ONN/C6l3VWo7Np1Ui0kwAAy7za8m598Ne2XA1KNmKJUAxqAEqQTErGxBgFfX5vPe0cvRzim8Uuz7HJqtJkSndSjmQTIJAH2ucjUR7z0wMFgwBJ1GNrwNtt/xnGrOeWhQFF0QrVdtbPTDBBqlRMyoMtcXWZxnKmTIqAkaFYSgH2ot8I6xgp6shkxuM+APRYINWm5MyYIjYD3/v0xOrUubBQSGMCPKBF9oO8D0xDKsrfVgaS28liCRcWA6j8MUeNXIKEWusbLYgx02M+2AkTbL6zBuYncsxIG2wjqTudreuKiA5hmCiem3Xbn+kY9yOYCuxAG0XAt7TseUi+JVsswQ1IkWJJaTJ53v8fXBqgKn3Kq1CCIaxWb8omxib2+/HuXUgAkSoOx2v8AjiAPhNrxvidLNkUinMmPvEfGRjANFwgaVV6rNTVCpQqswWJIPw3nlhz2qR8nQpd1WJSpVMpCaSQurlcgyZEwZ2ucY9KrkCmSeVt5OwDe0n54ecf7QlgaFzTS6GF2AQGDfcqTcWgWwa82SlCXJMN7LdpalE121GGoldJDP5UkEQw0w8tsY1XHPG+4PXrVlFfMIvcmogIQlZKKqhLsfDdmPqgxh+DcbylSk1AUBRNRQhYkNA/lEi0kztBO9hg3glSh3nciuzUzVE6vAgpaAWY7LJOpZmwW++HVXQ0pOjd9pOxq5tVr5cik+hWFMiLEW2Eqfnz2xy7ifAqtBitWmyHoRE+x2Pwx1/LcPoO9KvlsxqKuZRqpZmbTBEu0hwBEG0dMR7ScRo18lXQaS9Er3gOl+7ckEglTIO9x64lOHI7um6t4dSVo4Rm+GhuowF/0U9fu/tjp+b7EuENWk/epq0yAJmYiATPK464U/wDp+t/23/0N+mI/HHR6Cj0mb4lr8aFGa4QiUEqLmA1QuytTt4Y2Mk3n254Kp9lszrpKzLTFUa0Z2UKRNrzacBcP40lJgwy1OBMEqZYMIaTM3gczEWi4xq6+Rytc06i1qlAKviNRajIbblyLLykMbf6sdDcb7Hl+pkS/usGoUgazLmsww0BlGjxBiAZ0qsLAgXAHLB/Fe1wy5prllpUyVQLUUHxAgahUJNm9GkgxIF8ZDitdFrVxSqIU2BBMsIE6TMxaxM8+uEqtq0q0kAydJvpPMG8Hl8umCnVAluJs+I1GD1dQ7ySDUQmVM6ZXkAhIBlT9kkXxm+IZmn3gaCA1mVYEqRtOwud97YKy5ZWK1CSDaSd5n8jh5lex1SqhamnlNoE2M7euH4OWyDlGGjB0qIPhJsGJ3HlBjlsTt8sXUaJRWbS2kNAZb+awmPQHDHiOWeiWDCPskEfZFog/LHnDapUlnDjShYAEgaT5eRFzPTa1xicouPcKmmhZXylQEwDKAP0Om+w59eeL2XQ0OhYwSNWoSvhsNJN9yffBmar5dWU1EZie5khmuBPfGJ5nYDr8z85Qogp9HqZch1JMH/D8eoCb7QFMkHSB1wtDXasW/QS1SmWJKmT4iV5xCzJ8wMxh5xrj3fUqUqi92ulCs3C6hqY7NNjI5jGRbNsSorlxDTbcBmBYxHPf398a+hkFZ0qVVtpQKhHlAWAzrG/hBCxYkE9CV2A1bsC4PwY1RrralU7AWY87esYp492cqZYjV40byVF2I5T/ACnax62nG1ytVWJ0gwthAB367n/iZxZkqySQsubDuo1B1bwjzRp085sVAGJTj7FMeeUHdaMTkaMUgPjgmhmDsbN/uxqO0XZoUqQq0yAZAdfsidtPMAG3P4Yx+ZptzQn2I/UY5JY3dM9XHk9SHKKGNj+Nsc8zLaa7HeHP441f0p0IZlaNrxz9j6dOuMlmxNZvVvzxXBFps5+qtV9RyrkqJvbBnAKatV0VGVaZMsxMEx9ge/75YhIJCLJMxtH44d8N4cA0khVSCX5AtqGmTuSSPjGLRvwU6qUFCpMccEoTUOk+F9QgWDqQfCCRaRF+Vt7jGk48TQyIVe8dGAGsJ4SNcjXeUcDwz1EdIyWQyyCrIWmVEiO7dxEnchLG3rzxr+BcTWkrUwVCOSSgPkmJaGA8BnxCLGTyOCsk5T+KNfPR5sJLHVO9p0YPM01qKykSCIPUdPjhRwPU1QZepJamwEQPEnWd9go9o9cdI7W9maYAr0vq5Yqyr5QbwQOUgXG08sYDNcMqrmKdc6SEN9JuR6ggeu2GetM9TJWeCywWxElMa2Y6kAtAdWMyOfO/Sdvji+hU1HVVgmDcyCy2ESvIAbX2jEc5kwzlaU6dKsurcgqpkkADmL/DAQ1AqdQIWAJ5dbdMPX+jyWfLkzGqJJMxFiPfrbbEqD6l0s0QYG51XNhy3iTPMYKy+fUEUy3hSYaWk35X8PT2HriWYbWEJLOY0rECCDYiNoBAv0waS7AqxdncsFA0tJnkDHPY/CMe8PyBqEjaBMkwBAmSenL4jBX1IkOGDNOrTBAuOZvIviupRqKNcllfVpMW3Av05fL0wq9mFx9il6bSxi4vbkeXtyxA1gCmtZAswFpEfOcELnDqh11T4YPOREb4NotQY6QHQqZJBnVtyvsQY9COmABt+T6gFZqegMNThdRE6gDy5TG5G2HWeWnSbMGmXKgKoBuVMCQDzHhYz/mPTGebuxrjQ4MhTBB8+qT0JAi3U4Oq5paOXUqSNVWQVMGyk2I9Wj23m8tEWXhjbs0MwHOZoMFdbm3iYASxFo2/MYvyObbOZhsy9QU1rZumlQRCuDYFhMBVUCZ3k+uMlx7P6qtQUye6dtag9HAaI2ETFsRoQtCprn6wAIJvIJ8UfyzI+eAuw7k222dO7P8AaiplqzUaVOhUVahP1TipKgQ2gz0E8rk740X/AKj/AM3/AOiY4pwKqq1Q9RnAXbRGonYRJF7zuNsbX/qlL/6iv/8Ajn9cUjxSIzi/Bi3diF1AEWMQARPT98xiVeqyXiZtFxB5AgGMW5PLmk57xtEgW0zF9txB9L7jFiZM1pK7rckXi9m/e0Yndqiz9wbd4K+pkkEAb7+334Pr8FZGRgJpncgx6kMesY8zmQNFVdnpO0xKvq2EEEDaPT1xbks21cmnK0wFaprM+LSp0rE6bmFFufwLRUU9iy5ta7h2VjvKYNQMGOkCd5MQSbc9z1x0jg/bWjlcuKYQyCQN9xY3536Y5kU7ymUCFgBIjdfUX5TtzwtymeOzk6dJX4kfrfF1OMtVo5I27ltD3tHxJc48hdLAm4uCDJIIt+e8c8Lc9n2Wi1FSSCBTc6AurS2qJmSASPiTFt/uEq2XKZ16YemtTSFfZ20yR1EKZB6j0xSMrVrvTUXTSdIB1d2u4TqWEDqfEMTyytnRBcVbYmWSPXnhzwfs+9eolNb04DOQAIMwRtNxpPpvuRLP/pLV6lOnRC06JRWaoh1FpCkiYBHS4gQd/KdV2bZKVRqFLT3VNoiwJMxJZr28Rj88RUvuPmbhSa2xdnf4f6C1TLQXB8tQ3A6oTzO0ttBgjCJs69M6K1OWW3jJBtY3Eg++NtkePVMw1ZUNNNJhWAMkFjpBkkTA39TbFtRVcN31GahaDTIBSobLqiCRBK+Jeu8WCS29FY5fSfp5VZlcnx9AsNl1MmZDQf8AbOKMxxupqDUZpkGQdRY+1+R2IAw8432PWnSNWm2kg3WSVgmLT4pBIuScZZ8s45A+x/XE5ck6PS6fF0+Rc4ocNxapmAC7s0fZP2T7C0+uBqgvbfCoO6HUqtPTSYPvH48sH5TNLD1GBhRLDnpHL3YwBidM7ouMVrQHx5lVJvYggHf36X2xkshQNR9XQycPOPZltJv4mOomB8v30xRw+kqJ4nGprm/3YrF0jiyR9XKm+1X+xNlJMzfqOWHnAeK5gN3aw67nXeNhMzM7COsWwLw/JGqVgEIxjVG5gm077b7DGo4LkEUK1pVYsbSfMT1uIHSDgxUrRHq88Emu7GGRzJWoNREkbEwFJssmDA5ExznYYjxLtM6MabUTTddwx1x7bD43GKlAZiRswFjufhNh6HocMK9OlmKQpV7VUH1dQ7kdJO59DvE7yRWV+DgwShGdZI2Z1OPsyik9VmpgyJAhffTyGwnyj02srCZB2PPC3iPCKlJ9JUkDZtJIIgGQRPIixg4pp1qlIQFLL00m39Ji3ttiNu9n0GNxUfh7CgVzSomnUlmCmkh/k0NII6zqHQEWM4CTKnuHrFCyhtHmFqkBhIB1adF52uL8sH5o96asq1nV4iGhlIYD1kCDfliWbylQUFbSyBQdQ9QVAII3kMwk/wApGKuR4M41NoUquliTTU7QGUMRIvbcEb/84aJWWpT7pKQDo2uodXnAAjzXDbxpIBkmMLcxTIqaakjw2O8kgW6enXFNJaiwEEljZVBZj6xE8v7YFvwBpBNaqHRA+o1CLMT4VWSAsRMzctMCNtzj2rVQMQhHd6jp1XOxjVb4fEbxiNXM1FKPrJNOw5ENOo/I/hiighh6pRiikB2GwLbAnaTfFkrXKyd06KqqxpnrMXt8IF+eJ065WGUwCCBEyZvc74vrVUfRAkahJYTG8CwvYG3PANcBWgEW5ifvB2xMN2X5eoCGEQYZpn0JNuvTBfEE1U8rT1STrJ5mdQXl/ST7YVU3A9yPhfB2VzR7wMWjQCOW0HGs1HuaUEOsguQoXppBFhaxgAcufXDDMU+8pUKKsmqjSYuT1gNEjeLiOuFXdOQkNDT5Ykj2g3x7WrOJInQ8gD5SNo53jkcZ99GXbY77K1FTW1SkSFRlJ2Yl9Om55SJ9ifTE/wDqWU/7NT/X/fARRHoN9Y47oLIXYlidIkgc5WDO2Ff0dvX7sH1DKKHQ4g6rVqN4y4NKmCsGGQr3m1yFMTeZIm2AkoVsuo1Aha6koQwhgJBmNiNWx64lW4szoEcB4GldX2P6YiJ/IYvTMM1ClEu1JiSC1wDzEx0HU74PzBrseZPgz1Si04qMW0lVtHOWY+ECZEzh/lUSmYVZUMKbk+HUpYKwJMRe4vMbb4S5biLCoz0tQBMsLE2iZgbTJ/E4c1+L1czSKlEdgQP8zETpaJFlgSDMhjsBiqajHkTpyko+wTmaS0hUzFCqOS9yUMrud5vETytzx5kODnvG+kZeVqhTTctERBbQynSzRFtr3Iw1q5QPl9VMAPF9bGGKgzJjfwwJHTC/jufrrl8tk3phtDd5SdizEEKwIAYktZtjbaxviEc6yR4L+UIskXUk9uxh2vo5KklMgkq5mZLSRAQaZ8QGpvF4vFrX0x8cjVrZWl9LSqxpH/26UlIqFeQcqIRZAcGzkk7WxPstw8sPpBDPVBN3LOfJ0gQCQFkWWbDG5q8WylOFgB1AZg1Rd7ELLEKZg3G0DaRjn6vNPCrivz/RF8UpT+CMVS/n4mHoZautSnXCPTKHUEWgdB+ybQYUrIgn7V73PtWk9SsSC1M1KgRVpSFph9IkqZupkzEQdsaun2oy3h8KjwiIbZtJ8MkAWIUapg2NoOL8vxHK1wqkPTckqZ01EVlUMdTIWVRBkSw59McUOvyX8cV91+aKZ+l6hK6b/n5GNznDqmXqPSWpRLzcAAAiTHkAMja/rtgrh+dy+tq1aqjVlUJESFgX06ReTPqJI6yr7e8Pag4RqjHvNRABGkJMCIuedzhWeJnMVaa9ysplyrtTQBqrAiHciPEQIvaSTzt6Cy2r7fUb0Y+l6s7rz7/cf8d4+Kg7umvgJuxEExeAOQmDhMjr8cT4flQ9J3JbUrfKB0wKFviXLkz1Okni+LHj/wAXsucsdgQsx6k/yjoThPm570qg1UlKmq1iJEgAegLH3gnDHMPCmTuIS/uC3X2PocIsxUpgVAZ1AKFgneSGnlYdcNHTKdQuUGCl9dQTz8R9BNh8gBglnEzFvXn6YH4eNWpo3MAc4FgMFLQm5/sPbB7GgrWjXUOJUq8KsoQIVTCzMAgEWgD4kbYPocOsw7srJY3YRqabwNgZItyA98YjTgqjnqqiFqVAOgY/rh1l9zkn0D/wlRrXyT/y0t5g6oMfjsLmbgWtivuikM0ooJ8WsQDtMHe3zuIMmct9MqyT3tT/AFt+uK6pZrsxJ9SSfvwXkXsLH+nzvcjeP2lpVqDoAWqE7EQF5BhJmNyPv54RtU6/v8vwxnqJKkMtiP3B9MN6eYFRTFjzHT+3rhOd9zuw4I4lUSrIZynQ4gj1h9TVotTfedi0j1BVb/5sS7bZqnTqpTpEii6bRd1JYgz1JCk++AeKpq7k6QxFZRB2IJgg+hGLe1fjJUQ2ghVXmBpFwdt+Xpf1PejzOpi45W15E3aKkpqJU1AsR4gth4REidgfywLkciWptmNWkA6Rpb6yQJMCPLBi8bnfF3Cct39VaTVNBAO4USBJIufMR+eL+JdmqiMoRkZG1ETIK6VLw9tyAQIsT0nFuOtHFyfZitQFuGkgc/zHWMW/SjSpsoIKuZYbQTFo9gNumAcysqYVuUm9p29seZGgG8MknmLC25NzeL2wNjdyyrm5GkfDkOf/ABOBagHh8UsRe0R6TN/uwSiFHYSGMXbYRysdsSocMklyGNIW1iylugJHvjGIrlkA8TEtIssRHPfniWc7pAO5LwbHXuJBFjA/P3wPxPLvTqFGDAwCJEEqRIPrb8MVVKhsL29cEAXl8zpMiek9OWLarwpXceaD16+/L2wDSUmJPh3gHpi3MUpJIJv1wEF7PK1bwLAgc7zLAm/yIA+OB++brgjNU9KUtQIMNb0LSvtM4E1YIDVZbKUKZYuKlwSksslCSBcDwtzmDEfHAyZykKrlEJp6SADE+W59IMx7DANCmzOoW5qE3kfEkHY7mDGCspkUDVNVUEKxSRF5kalBuwtNhaRgXQyi5PQx4VnKpqKaTikRCSqjx6yZDQL2tGLe1HC2yOYNMkwyhkYNOpTzDBR0PK3ruR3pjKuppnvVZfCdjrAYRF7jUPgR1wfmeNGrRZMw3ighbeQSJUXJ9fl0xGXqvLarj59/l/PmPbx68oeZLMCtlalMAjUvM82FyCOQYH1thvSpF6VHUvjC3MGBG5nb78YvsrxEo0kFjBgG9gRccpGqbXBg46Dl+MrUGoVCf/MjcyZE8zeI5DpjlknDJfzs54YfTmnF9qaH/ZnjAoUyppsQbj3xluKI1SsXCHxEnYmPa1hhuOIq25E3vMGTzJWJ+Mi5ti6tmqmhu6KloOnV15eIC/PcLtjux5sOTUm4v7FZdXmwy5Qxp/R19hBR4dVaSqMQDBtzG/uR0GBs3lSylbqCIYjw2g7zuJixxoF4vUWlTp1KTUym7eYEi06hIvc73xLNca8IcaWA84B8UfzLytzsevXHNBxlKp9v9nfP+qZVG4QTf1r9GY7NcMq1FAZ6jaQAmvU2gdFHIWFvTEOC8OajWDlj4lK7EdD+WNq3E1idQjeQWPKORHv74Hr8QpkwQCRfyUzBjTsVPLr774TLODi4xT/Gv/SObqsvUY3GcEr9nf6IzmQMGssESZ/L9MKaTSIEz6Xhbyfe1hjT5sUY1AKsCJA0EATcgeFtxMiSF3nGO+laVdF8xZpjkpPz/wCT6YTC9u/kH+mxnHLJPyl9tFXEMwCWfZRYDoo2H73wu7O8Mp5p6xrVzRWmmssF1/aVYj/yxXxKtI0D44Yfw4DGvWVCoZqDAa50zrQ+KLxbHVjT7rudnWyqo+BzQ4NklAVeIUoA+1TYT73+7BuV7Kd8C1LNUqgBgkAwDvFib3wRmslmFiRkmkE3Ony3bzCLC+HXZjwI4qLQpnWbU2WDCiSY5gRPpGBieSUqnjpfU583UOGO8c7/AOr/AERlafZzWdKZigzEkAFmBJEggAruINvTDHLfw8zreVaZHXWR+KjGg7OjMJVq95RqBGqs1P6yhoId2aWg6wR6Fpk2thzwbhlWktNVpsB35Zu7qAOydy96rKwVm7xo1EywVSb4tOCXZHPHrs102jmmU7M5t6ndigwaSLlRcTaZ3tiVbs7mEc0zTGtd11pI57aumOsVMnVox3WXAcxDp4jLVT4XOoGFXSSxBB8XS4fFuF5gVBXDVWirWDUmddDUyrtT0g+U6xTAI6mbCMBQi3Q//PzJW6OXPwKv/wBpp/qT/wDrFLcFzIMik0jYgr+uNdwbvy1XvVdVATTrFQHUdRcDvPEQBo2MbxG2Mz2kztNczUU5mvTIgFUZgB4QdhbnOEycYRUqZbB1mbLNw193+p9RyFYOC1F4Bna0jmImPY7Yr4bw/v8AOV0ZlQKPEzeEhIJOneWLwOVl3wHSzqlgBnszJIEd4/XGr4eBUrtl0atrqliwpkMgHeNLMpNmAC+KNoGq8Y2KayJ1a+pPqlLkuf7fmcrz1fuqpNJnQgn/ACnYrPpIJGHNfhuYGWp12cABZBltQUjnFgYgb7C/TFHa3J1kGmqoZVcCnVClSwIPh5DaCREzNzfHmZ7Q1VCqSQpSCkKb8xMTYECLRgzeVJen+JyVG/iEz1QxGqYmD+x88Fvw7SupXEibXBuPl1wt1iZA2MxynF/0tnI98dE5OTthioqLvv4K8xKSeREfLDCnmCiBD/LFjMH4euFNYlmA6mOkXjEsw3iIBOkEgT0nCVYtjCuHqKKjLUY+RWJOkAbiSL/O0YGzeW0IrBlbVyW+n3PWZt6YY8P4rFICobAwsDkAP13wnzGYLE9CxPzwewERpmBfmLYnSrRvOKC5kHpi5ED8wIvfn6D1wAlgohoMkSBv1P5fpgHvD0+4YPzFCJOsEQNjz6YEhf2TjWYf1WPeO1N9Q5TILbTyjrijIpSDE1ABAtTOoSReJjY7b88VB8UahMvt7xb3x19RhhjilFk4Nth9Q94ZTUDM92BIncwRECIuQThxxzL0qdNFRtdeogZ3aRuLgT1uPYDCemS4q1VK0igkIoCgjYgR6el8G8GpslekijxMB4m2AO8bxzxyeLXgpJq0vc1HBOEVCuXVytN6QZwhABZKrbkEg/ZB+HqMLu02cajWUo8QsAKR/MSZ63PP0w84DwqnVzAqVmKUk1NUDmxVG0iNW6yCuodORjF+XyqZutmjmq4OUIdqKrUAKAEFDTQ7FBYwPF4pmcT9Kpqf4fUk0pbX7GcevWzFJaxzMmnaGREAIPMrAAvuRjfcJ7aLSpqtXM0ajAXMU9/ZeWOfVq3d5UsppwtdU8BU6tCsQZF4Ag32hfTGi4d2SzppU8woydOk9y9U6SJJE6dOxEECRPxxLLKUl8OisY8e5o83/EJoRaeXpEuZ1oNQ0BoJgbbEXJwZ257Y5fKBQgy9So58oVG0iNz0vsDjK9rOx70Mk2Y76nUdG70aKYUMmnSYYOxMWYHYQY3wrr8MyNWmubpV61M1B9cgpqwE6dQPiGkMVYzcEttFsVx/2bsnJO7TK+KcQqV2ougWmWEuiIFG+8L1g4pXMFgIZhNvMd5jr6/dhPVzy06z1qdZ6mkwveCC4sJa55fhPpiVVHajTrKWXUTC+oNyCDcSLTGEnjqK/U582HLkkuEqGtaoB4iTpDRBM9eu+FWXqLVdmAbeQTI/C04MVSylXkbMQByJO3pHP0OLqVEBAFgITYjrG+ILG9+53dF1CxyjOfiNP8HX7MV5jhitJ8V+jfqMfcCotSzFMUSwqu3d2O+oQBttMH2HpjzNcVUSv2hynn0xd2L4lGdoF9QPeqLW+0BEfH5T8TeSMJSXhM9jqMuFU1TZte2fEquUo00Wp9bYFyFaTuTcR1i3TDb+FGXOcSrWzFQMqOaYTRTWToVixZUB2YCJ5X6Ywfb7Oh6zimrslBjrqTKjWw35C/hHy5YE7E9oqyVqGWp1e7ptmRVdhuRp0sCJgqUG0eYA8hgf01ZFhTyNtve/mcHUxhVJK79jsnb2vRyOWV0o94zNoWWgL9W3iIAuIEabTMSMV9jnWsv/ALlaK1mGuaJYSpAg3cmTe8iR96f+KvFaVTIDu2DstZWEEMY0sGkD7MHnH3Yyv8Mu0K0KtWkzin3qzrJAAOmBc2EbjHorZwyhxW1s0vaXtt9AzzZWpQ10Vhwy1GLeJDur2NyQfF674J4Z2tytfLHMNUej3ZXXTL6ovpXyyWBJ2InfaMcd43xCpXrNVqMWc2JJ1bW354GXKPAaxBvYyQB1Hz+Rxr2DjaOhZjt6lSrpWlWk+EFaguJJkKV3Nt7wI6ybw/igqLrioFkeJgH3B3i/Odo8IxzvJIBmFYkhEYFmkCB7++Os5HI0aQVdRcBZDGY0wNlQ6SCb8+V8cXW9bHpltN32ovgwcxHm+0WXpaVOt26lADudyYHyGMzwjjn0fMHiKgklymiRZGVZkeuq0c1xqu1uWyjU6lepC1gupSX8TNNpDS0k4wOaZqadzSGtTBLqA+qJ8hH2evOw2xun6lZ4WrVe+g5MTg9mz7RdoDxDKqdJRVYNotvEXY8ixMNGy7TjnPEqwg04UgGxnVHswiZ5yOWNLwXJa8sHUwWltJJGogMB7kAED+o3HPOcVpgRESQGEdD19cdkotVuycYpxvt9RWzGffDPhjIilnQOx2mPCI323OF1CnqaDIHM9B+uGVQK2w5bgdPbfAqwXQdnKNJqZqABTGpWFiCBI+/C+kaJaaitEX0m8+3rjzOue7CDaR+P9/uwvrNc4HHWzWX95Th/MBB0AXuSI1H0H34O4JwQ1ld2JUAeGI8Te3MDnH5YUoskDebY12SqJRogM28i3M89sNFGlozPEMp3cAk6jeCMfUKR06jEDcc8WZ/NGq+swIsAOlz88WGi2mxF7xgV8w2Rz1JbkEcrfDAWg/y/ccGZbLnUxawBieh3xf8AWdT8/wC+Fcq0MoN7Nj/EDgNFadPNUgVeo+itTHk1hSWIi6ksDYGDfbmP2dztOi5Z6Sqy0/DpEq0kQbTfqfQ4oql8+aCqEphRcXUGod2ta8CP6j1wbxXggp06YQs1dV1EDmpJksWIIiJEb3tzw7bbvwKsTcLM92mzAesaixLiagBkTMCPdYwJl89pcER+ntf9++BKzAs3VtvT92wZkciCmstB1hYA+yQZaZ5bbfHGZoOhs5qVKOulTYopY1CmpovI1AHn1I2udpwrp5sG5Jj06/rhhxjKtlW+oqk06ij7UH/MDHrf4xfDjhXCEzPcNWqJTVKfiMeKpJ8Kxt4APMeRFsCLl2SBmyQ/uk0ifC661Bl1V01UKvfVKZVpcOwaRpVgSIIIMbjF38SOOVqlVaQqa6EaggFlqEmZMcgQB0HvcvtHxTLUKS0aSoynomm9rkxMgc98YjiWc72A142mBz9IF8F46e2Rx5fUelr39zR9keK1kovlak928shsYkeNbbAi8f1YyGUzz0i2h2UMpQ6TEqbfLBGW4k1N1qKLqQY5YEz8lyZT6zxwhJC6iZBkDxDp7YLqiiTssymZprqLgtaEHKTvPsPxxp+C8ZohEpNYAQL2359JN/8AnGPzOTZUVjOk7E8/364NbhzaHrEFdFwFjcEAGNgoPTCuV6G4jt6dSu9dU1EikokwJgyo+N4xTwSnUSjUDKVBOqGEFStrg9RI+XXFHDOMnvGJCguBqiYlZg+kz92GQzmqef3/ADxeOJTV2QlKri1ozdUd7WYoD5iduYE/jfBuQzRos0oGcLILEgg+vI/ZInA7VSKjFbEHlIg88VvXVmJliT5vUxviEsdHRGVJD/PZ4ZWlUpI2t6zg95AjSt/K0nUTe/IzzGGlGoTkWr00HepZiAJUkkSZ5EFZH+Y4yFTiIdxUdE9FVdIAACiBysBfrg3hLlqVVe8YgmBPLw3kfG/LfG9Gkh3nbly8hfZ7iWZr16aksylgrgBQCuoMwMgKCQIvHTHnHc0KWbU0NKhER/q4UM3nnw2NiBHpGKKCinTqGZ1KQYtbpB5zhPU0iYAZj5iZ0g/5dj88GOOndAyZHN25Wb3jFGgmXWv9Fpk1QpBMRLDUZi/y9emMyr0TUB0akJJFMMwAnlqUhrHmN4wDW4y7U1pOdSp5ATZBzAG1+pwVm86gpINIDaZEKJljBltyIFgeuNkin57E4trwazjfAMjVyoq5d1p1CRqDVS0Wuh1MQCJ+OFC9oXy1KnRUrUZQQzHxLEwog9BaVIEAHecZhKs03E9DHt/acUik5AYXG/7+WJzUZ/3IaNx7D/i3H3r0WSotJRqBDJTYeITAJ1HkSAML8pxs06SU1pqGSW7yWkljN7xAEAe3rgXi3FDUVacABb22k7n3OAmq2AgWG/PCLDBR4paKzm7uxw/HXGkz10ggEASOvqJjbHnhKFyqw7RCTIIUE25b7D8MK6dQGQwkfZgxGLsrWUSrOUEEq2nUQekSOgvy9cVS0T5MnUQ0ocEHWsA2leoI5GOfvidMAC2KMxV7xhyJEH5cv3zwNSzJHrhkxWg2tBkTc4ASmTNtrn2wahJQvfxch7+v5YtyeYpLScOGJLfOBYH0mThWzIHGXJTUBefCALn88ejMMyhWMQefXn64hl8+xqKxMKCDA2Ef2xWwLEvpMTPtJnA2kPpsYKDBFr2uJwT9HC2BkRzGA6jKU1htJnb49MM6N1vhsa5Dziq+E9RlOhAkOW80npvHwAvthx3CdW+Q/TGXzTozaLjTeQef7/HFfdf/AHW/1nE54remVw9V6apqxrwgONVOmCKp21DYc/3thpwTLNWerrrBaonUziWmIBvaAY9gLcsLeAVXOZDMSTpYsT9lbGTECJi+18aHOJq1mm+jvLFgAZm3pYSeeKctUcvJ9m6MdxrL01zDCmoAWA6zqUOPMFP8s9ec8oxXmc2KmlV0+HnYRPTph7xfgNLK1O8QVKlECRqix/zlYi9xbnGNX2m4R9JpUKiohZFIYKseYKSfCRPiXblOM/LMnSXzMNVYVKaIWXvpgSeXvt64Po1e6pKrsJmD6+3ww4yTZPLDuq+WWq2khhoDOs3HiMMp6QZxhuLnRXdS5dQfCx+0pEqY5GIn1w0Mlq62cmbpnJ8b13DuNVu8K6bhftDqQDhX3yAFSoYnZjMj2jBwOlVCiWMkqLx8udvuwFlKRJktBN/hjOn8VlsUOEeBT3nriQfUIgAiZPMyZv8Ahgni2VVYZTINptv8OcYoUwjMfSPXAVDvTGGS0VEPfVnUofAoAK2HME7+2LK+eqS3igOpVoAAhiJgbfHHmRyCqisx1sfFpIsP1x5xPJDQXSbbqeQ5kH8sVjicbbROWVPSYLw2gGcpr0qduZO+2KMhUZXlSZNgI39x1xdwXzzzG0b9Zg8sXcOJ7+mU06mP27C9/hbpzxLadorp6A6lR+9YMsMx2Mi8DriLZZk80RO4M4MdnqVGbTctMxsDt8IGB81mbRzm2Mny7mkmuxQ9Ih4YEGbjaPhhjl8zSpwoJlvMTy9/7Y8yoAR2eGZlMHp/eYvhTUEtgJ7DWjRZpS1J5YLAm835wIHPrthBJ0k8sE0KZdH5BVJn1HLAmWqXjkxH4+uDzBxoKWiU0kgEGD1meWL+KFdWlVgII5/uMe5Ve91EiyAsBf5TgXOZo1D4ekE9YxKrlY90gam+49sWtUgEgmTbFNGx8X34ObKNUCuoUCIsYmLc+fucUsWgNqk+a59sRqEcsX8QCa/ApUFR4ZJhohoJvEzvizM5cowUsuwMztP6YzMBobYMyCBkbwgtqETv/wAemBMwgDEAyJ3GJs0ARIxjdhhUzSsCSsODYjeQfuAwuXLmQv8ANcEfEY9y+s3UG28Dl64sy9RpBW7Cfbr8sCqDdheRfSsNbSSL4sr0gyPFyRNvS+FXeliWO5wXkkLDRq03+c/8ffgqltgpvSBqFNtOobA9bk+g3OLkzjbG4PXF5c0n0AhhaREA/ocG5H6PVlHXuyRZ5Fr+w+/G7gbce4ozVQE2AEcsPslW+qQlQTp3IE8/vjGZrUyHKncNp+MxhpxavDLTSQEjbrAxjANRpBbYk/KcUTgyukrruZ3m/wB/XA0DGuw1R1PJ9rcvQ72oKDB6gvGiBa/Oyk3tznGJ4Vxs98uttNObDYD09vwwHVY93hcdsPdCJWdMr8YVYDwAbG/I3uDAi/X2mMNOG9oaTMKYJNt4kHnMibW32vjlFRj3VK/83+7Drs05CuQSCAYI3FjthZTa2ZQTDe1uaRsy1Sm2oGJi1wuk8r7b4r4MEZzUaDC6YIm3QSLb4WcYqFq7liSdIuTP2Ri3hR839OJvey0KtIrzKvRNRQDpg6SDAGoenSbe2ABFhudgOuGtAzUYHmT+OFtD/EHs2KpVGyTduj0ZJz4ihAIn4Ypckr3bTKnaI/Z9cPOEm5w543RU8LDlQXFcgNAkAi4B3A9MThJzk0POKjFMzPDqoJIFoEi+/wDf2wwSvAPQjnt7YzlM2w4qHw468Tlwas58kU5IUUHh7Np3G8Wx9l6pJE7KMCvuffBVIfVf+f5DHMy8dMcZbPSIcC4gEmPv9Bt7YWcTpgOpH2hPytiDbN7jDPtTTA7ogAGIsPQYWMKdlZZG4UxXTcA4HF39Jx9RxZlxc/0/mMVk/hIrvY6SoBSdNI8SwMJypjTzG04fL56f9A/A4V5gfXMP8zficSXudefi1FpUNOHZcVKYpU2KuPETyJB26mem2E/FqxesTGljuJ54edmv8Z/6RjP5n/Hb/wCQ/wC44biq5HJbuiGbqSQSAAFAHw6+uHXCkL0kXbePcemFPEdh741PZz/CT2/PGUeWjOfHYv7S5J0GVkkjTp5Wa0/P8sQ4/l1VadRSNtMHc8x+eHfa/wDwaX/yj/a2M9xv/DofH8sUa7k4u6A8xQC2sQwBBje3XAiUC0xeBPy6YL+xT92/EYqyR8fwOJdlZXyHdneIJTMOSLzIvyIv88WZ1aVPx0mVtRgjUZE78trffhGd8ePtjUYlPS2CeHt9YokgNY3Hw32vF+WBeRxLKedffBAfM5mZvi56urYRzMc8DHbBFHfAY8VZ9RfQ4bf0xPMsrktsSb+2B8x5sRp7YIBy9AoFJA0sIgb7T6TgKaX8rfPEuHue8Ak2FvS42xpu6X+UfLCXQ3Dl5P/Z' , ['alt' => 'pic not found', 'style' => 'width:100%;height: 100%']);?></p>    




                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Ver mas &raquo;</a></p>
            </div>
            <div class="col-lg-4">
            <p><h2>Feria de Productores </h2></p>
                <p><?php echo Html::img('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRekyZBzpezTmWxBhV42-WzTUlWhRYIjjNPZA&usqp=CAU' , ['alt' => 'pic not found', 'style' => 'width:100%;height: 100%']);?></p>    
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Ver mas&raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <p><h2>Feria del Bicentenario</h2></p>
                <p><?php echo Html::img('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTe9g9DN0kfN_rGNgx4R4sWyjUUw46zKSqo4w&usqp=CAU' , ['alt' => 'pic not found', 'style' => 'width:100%;height: 100%']);?></p>    
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Ver mas&raquo;</a></p>
            </div>
        </div>
        </aside>
    </div>
</div>
