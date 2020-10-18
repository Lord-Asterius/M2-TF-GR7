package acceptance;

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

import static org.junit.Assert.assertEquals;

public class FeatureDeleteModule {
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^l'administrateur  est connecté$")
    public void theAdministratorIsConnectedOnAModuleModificationPage() {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Gestion des modules")).click();
    }

    @When("^l'administrateur tente de supprimer le module d'enseignement$")
    public void theAdministratorChangeTheModuleNameWith() throws Throwable {
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(3) .navbar-brand:nth-child(2) > img")).click();
    }

    @Then("^le module est supprimé avec succès$")
    public void theNewModuleNameMustBe() throws Throwable {
        List<WebElement> elements = m_driver.findElements(By.linkText("Supprime Moi"));
        assertEquals(0, elements.size());
    }

}
