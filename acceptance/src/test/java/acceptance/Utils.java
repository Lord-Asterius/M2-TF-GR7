package acceptance;

import org.openqa.selenium.By;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

public class Utils {
    public static void loginAdmin(HtmlUnitDriver driver){
        driver.findElement(By.id("login")).click();
        driver.findElement(By.id("username")).sendKeys("AIstrateur");
        driver.findElement(By.id("password")).click();
        driver.findElement(By.id("password")).sendKeys("Az12@4567");
        driver.findElement(By.name("submit")).click();
        driver.findElement(By.cssSelector("html")).click();
    }
}
