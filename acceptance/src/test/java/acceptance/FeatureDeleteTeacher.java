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

public class FeatureDeleteTeacher {
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^l'administrateur est  connecté$")
    public void theAdministratorIsConnectedOnAModuleModificationPage() {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Gestion des modules")).click();
    }

    @When("^l'administrateur valide la suppression de l'enseignant$")
    public void theAdministratorChangeTheModuleNameWith() throws Throwable {
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(3) img")).click();

    }

    @Then("^l'enseignant est supprimé de la liste des enseignants$")
    public void theNewModuleNameMustBe() throws Throwable {
        List<WebElement> elements = m_driver.findElements(By.linkText("Supprime Moi"));
        assertEquals(0, elements.size());
    }
}
