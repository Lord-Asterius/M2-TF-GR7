package acceptance;

import org.openqa.selenium.By;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

public class Utils
{
    private static boolean m_isLocalTestEnabled = false;

    public static void connectToSite(HtmlUnitDriver driver)
    {
        if (m_isLocalTestEnabled)
        {
            driver.get("http://localhost:63342/TF/index.php");
        }
        else
        {
            driver.get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test7/preprod/index.php");
        }
    }

    public static void loginAdmin(HtmlUnitDriver driver)
    {
        driver.findElement(By.id("login")).click();
        driver.findElement(By.id("username")).sendKeys("AIstrateur");
        driver.findElement(By.id("password")).click();
        driver.findElement(By.id("password")).sendKeys("Az12@4567");
        driver.findElement(By.name("submit")).click();
        driver.findElement(By.cssSelector("html")).click();
    }

    public static void loginAdministrativeStaff(HtmlUnitDriver driver)
    {
        driver.findElement(By.id("login")).click();
        driver.findElement(By.id("username")).sendKeys("CCépacaré");
        driver.findElement(By.id("password")).click();
        driver.findElement(By.id("password")).sendKeys("Az12@4567");
        driver.findElement(By.name("submit")).click();
        driver.findElement(By.cssSelector("html")).click();
    }

    public static void loginTeacher(HtmlUnitDriver driver)
    {
        driver.findElement(By.id("login")).click();
        driver.findElement(By.id("username")).sendKeys("GMendufric");
        driver.findElement(By.id("password")).click();
        driver.findElement(By.id("password")).sendKeys("Az12@4567");
        driver.findElement(By.name("submit")).click();
        driver.findElement(By.cssSelector("html")).click();
    }
}
