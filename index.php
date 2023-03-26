<!DOCTYPE html>
  <html lang="ru">
    <head>
      <title>My website</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <header>
  <div class="form">
       <h1 id="p3">Форма:</h1>
      <div class="form-decor">
        <form action="form.php" method="POST">
  
          <label> Имя:<br>
          <input type="text"  name="name"  placeholder="Введите имя">
          </label>
        
          <label><br>E-mail:<br>
          <input type="email"  name="email"  placeholder="Введите  email">
          </label>
          
          <label><br>ГОД:<br>
            <select id="year" name="year">
                <option value="2000">2000 год</option>
                <option value="2001">2001 год</option>
                <option value="2002">2002 год</option>
                <option value="2003">2003 год</option>
                <option value="2004">2004 год</option>
                <option value="2005">2005 год</option>
                <option value="2006">2006 год</option>
                <option value="2007">2007 год</option>
                <option value="2008">2008 год</option>
                <option value="2009">2009 год</option>
                <option value="2010">2010 год</option>
                <option value="2011">2011 год</option>  
           </label><br>
          
            <label><br>Пол:<br>
          <input type="radio" name="pol" value="Значение1" >Женский</label>
          <label><input type="radio" name="pol" value="Значение2" >Мужской</label>
          
             <label><br>Количество конечностей:<br>
            <input type="radio"  name="kolvo" value="Значение1" >2</label>
            <label><input type="radio" name="kolvo" value="Значение3" >3</label>
            <label><input type="radio" name="kolvo" value="Значение4" >4</label>
          <label>
            <br>Сверхспособности:<br>
            <select name="sposobn" multiple="multiple">
            <option value="immortal">бессмертие</option>
            <option value="throughwalls" >прохождение сквозь стены</option>
             <option value="levitation" >левитация</option>
           </select>
          </label>
          <label>
          <br>Биография:<br>
          <textarea name="bio" placeholder="Расскажите о себе"></textarea>
          </label><br>
          
          <label><input type="checkbox" name="info"><strong>C контрактом ознакомлен(а)</strong></label><br>
          <input type="submit" value="Отправить">
  
         </form>
      </div>
      </div>
      </body>
  </html>
