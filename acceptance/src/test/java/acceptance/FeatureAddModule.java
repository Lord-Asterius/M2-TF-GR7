package acceptance;

import cucumber.api.java.en.And;
import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.junit.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.Map;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;

public class FeatureAddModule {
    private final HtmlUnitDriver m_driver = new HtmlUnitDriver();
    private final Map<String, Object> m_vars = new HashMap<String, Object>();
    private JavascriptExecutor m_js;

//    @Test
//    public void featureAddModule() {
//        m_driver.get("http://localhost:63343/TF/index.php");
//        m_driver.manage().window().setSize(new Dimension(1053, 750));
//        m_driver.findElement(By.id("password")).sendKeys("Az12@4567");
//        m_driver.findElement(By.id("username")).sendKeys("AIstrateur");
//        m_driver.findElement(By.name("submit")).click();
//        m_driver.findElement(By.linkText("Gestion des modules")).click();
//        m_driver.findElement(By.cssSelector(".float-right:nth-child(1)")).click();
//        m_driver.findElement(By.id("moduleName")).click();
//        m_driver.findElement(By.id("moduleName")).sendKeys("test");
//        m_driver.findElement(By.cssSelector(".btn")).click();
//        assertThat(m_driver.findElement(By.linkText("test")).getText(), is("test"));
//    }

    @Given("^l'administrateur s'est connecté$")
    public void ladminEstConnecte() {
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);
    }

    @And("^l'administrateur a renseigné le nom du module à créer$")
    public void lAdminRenseigneNomModule() {
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.cssSelector(".float-right:nth-child(1)")).click();
        m_driver.findElement(By.id("moduleName")).click();
        m_driver.findElement(By.id("moduleName")).sendKeys("test");
    }

    @When("^l'administrateur tente de créer le module$")
    public void lAdminTenteDeCreeModule() {
        m_driver.findElement(By.cssSelector(".btn")).click();

    }

    @Then("^le nouveau module est ajouté à la liste des modules d'enseignement existants$")
    public void leModuleAjouteAListe() {
        assertThat(m_driver.findElement(By.linkText("test")).getText(), is("test"));
    }

    @When("^l'administrateur tente de créer le module avec un nom vide$")
    public void lAdminTenteDeCreeModuleAvecUnNomVide() {
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.cssSelector(".float-right:nth-child(1)")).click();
        m_driver.findElement(By.id("moduleName")).click();
        m_driver.findElement(By.id("moduleName")).sendKeys("   ");
        m_driver.findElement(By.cssSelector(".btn")).click();
    }

    @Then("^la création doit échouer$")
    public void leModulePasAjouteAListe() {
        assertThat(m_driver.findElement(By.cssSelector(".toast-body")).getText(), is("Le nom du module ne doit pas etre vide"));
    }


}
