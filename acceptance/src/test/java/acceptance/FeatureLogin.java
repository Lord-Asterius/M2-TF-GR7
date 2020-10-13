package acceptance;

// un fichier par test Gerkhin

import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
// un fichier par test Gerkhin

public class FeatureLogin
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    // Mettre dans le given le chemin ou on accede à la fonctionnalité qu'on doit tester todo supr comms
    @Given("^L'utilisateur n’est pas connecté$")
    public void theUseNotConnected()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        m_driver.get("http://localhost:8888/M2-TF-GR7/");

        // m_driver.get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test7/preprod/index.php"); 
    }

    @When("^L'utilisateur se connecte avec une paire identifiant/mdp valide$")
    public void theUserConnecting()
    {
        m_driver.findElement(By.id("login")).click();
        m_driver.findElement(By.id("username")).sendKeys("AIstrateur");
        m_driver.findElement(By.id("password")).click();
        m_driver.findElement(By.id("password")).sendKeys("Az12@4567");
        m_driver.findElement(By.name("submit")).click();
        m_driver.findElement(By.cssSelector("html")).click();

       }

    @Then("^L'utilisateur est connecté$")
    public void theUserIsConnect()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("Déconnexion"));
        assert(elements.size() > 0);
    }
}
