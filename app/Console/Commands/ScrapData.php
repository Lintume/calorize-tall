<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;

class ScrapData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cats = [
            //            "/alkoholni-napoi/alkoholne-pyvo",
            //            "/alkoholni-napoi/vyna",
            //            "/alkoholni-napoi/mitsni-napoi",
            //            "/alkoholni-napoi/sydr-slaboalkoholni-napoi-ta-inshi",
            //            "/alkoholni-napoi/shampanske-ihrysti-ta-hazovani-vyna",
            //            "/alternatyvy-m-yasa/namazky-ta-pashtety",
            //            "/alternatyvy-m-yasa/roslynni-napivfabrykaty",
            //            "/alternatyvy-m-yasa/sosysky-ta-kovbasy",
            //            "/alternatyvy-m-yasa/soyeve-m-yaso",
            //            "/alternatyvy-m-yasa/tempe",
            //            "/alternatyvy-m-yasa/tofu",
            //            "/bezalkoholni-napoi/bezalkoholne-pyvo",
            //            "/bezalkoholni-napoi/hazovana-voda",
            //            "/bezalkoholni-napoi/haryachyy-napiy-chay",
            //            "/bezalkoholni-napoi/enerhetychni-napoi",
            //            "/bezalkoholni-napoi/kava-kavovi-napoi-kakao",
            //            "/bezalkoholni-napoi/kolovi-napoi-bez-tsukru",
            //            "/bezalkoholni-napoi/kolovi-napoi-z-tsukrom",
            //            "/bezalkoholni-napoi/kolovi-napoi-zi-smakom",
            //            "/bezalkoholni-napoi/lymonady-ta-mineralni-vody-zi-smakom",
            //            "/bezalkoholni-napoi/nehazovana-voda",
            //            "/bezalkoholni-napoi/rozchynni-napoi",
            //            "/bezalkoholni-napoi/syropy",
            //            "/bezalkoholni-napoi/smuzi",
            //            "/bezalkoholni-napoi/soky",
            //            "/bezalkoholni-napoi/kholodnyy-chay",
            //            "/bobovi-1/bobovi-zamorozheni",
            //            "/bobovi-1/bobovi-konservovani",
            //            "/bobovi-1/bobovi-svizhi",
            //            "/horikhy-ta-nasinnya/horikhy-bez-dodatkiv",
            //            "/horikhy-ta-nasinnya/horikhy-soloni-ta-v-obolontsi",
            //            "/horikhy-ta-nasinnya/nasinnya",
            //            "/horikhy-ta-nasinnya/solodki-horikhy-ta-sukhofrukty-v-obolontsi",
            //            "/horikhy-ta-nasinnya/sumishi-horikhiv-nasinnya-abo-sukhofruktiv",
            //            "/hryby-2/hryby-1",
            //            "/zlaky-ta-krupy/zlakovi-batonchyky-ta-zlakove-pechyvo",
            //            "/zlaky-ta-krupy/krupy-ta-zlakovi-plastivtsi",
            //            "/zlaky-ta-krupy/myusli-ta-sukhi-snidanky",
            //            "/zlaky-ta-krupy/portsiyni-kashi",
            //            "/kovbasni-vyroby-ta-delikatesy/bekon-i-salo",
            //            "/kovbasni-vyroby-ta-delikatesy/delikatesy-1",
            //            "/kovbasni-vyroby-ta-delikatesy/kovbasy",
            //            "/kovbasni-vyroby-ta-delikatesy/kovbasky",
            //            "/kovbasni-vyroby-ta-delikatesy/pashtety-ta-namazky",
            //            "/kovbasni-vyroby-ta-delikatesy/sardelky",
            //            "/kovbasni-vyroby-ta-delikatesy/sosysky",
            //            "/kovbasni-vyroby-ta-delikatesy/shynka",
            //            "/m-yaso/inshe-m-yaso-ta-subprodukty",
            //            "/m-yaso/m-yasni-konservy",
            //            "/m-yaso/m-yaso-v-yalene-ta-sushene",
            //            "/m-yaso/m-yaso-ptytsi-ta-subprodukty",
            //            "/m-yaso/ryba-ta-moreprodukty-1",
            //            "/m-yaso/svynyna-ta-subprodukty",
            //            "/m-yaso/yalovychyna-ta-subprodukty",
            //            "/molochni-produkty/bezlaktozni-molochni-produkty",
            //            "/molochni-produkty/vershky",
            //            "/molochni-produkty/vershkove-maslo",
            //            "/molochni-produkty/vytrymani-syry",
            //            "/molochni-produkty/dytyachi-yohurty-ta-dytyachi-molochni-deserty",
            //            "/molochni-produkty/zhushchene-moloko",
            //            "/molochni-produkty/kyslomolochni-napoi",
            //            "/molochni-produkty/lozhkovi-bili-yohurty",
            //            "/molochni-produkty/lozhkovi-yohurty-z-riznymy-smakamy",
            //            "/molochni-produkty/m-yaki-marharyny-ta-spredy",
            //            "/molochni-produkty/maslo-buterbrodne-iz-dodatkamy",
            //            "/molochni-produkty/moloko-svizhe-ta-tryvaloho-zberihannya",
            //            "/molochni-produkty/molochni-deserty-ta-pudynhy",
            //            "/molochni-produkty/pytni-yohurty-ta-molochni-napoi-klasychni",
            //            "/molochni-produkty/plavleni-ta-vershkovi-syry",
            //            "/molochni-produkty/produkty-z-kozyachoho-ta-ovechoho-moloka",
            //            "/molochni-produkty/proteinovi-lozhkovi-yohurty-ta-skyr",
            //            "/molochni-produkty/proteinovi-pytni-yohurty-molochni-napoi-ta-skyr",
            //            "/molochni-produkty/syr-kyslomolochnyy",
            //            "/molochni-produkty/syr-kosychka-ta-syrni-sneky",
            //            "/molochni-produkty/syr-kotedzh",
            //            "/molochni-produkty/syr-tverdyy",
            //            "/molochni-produkty/syry-dlya-smazhennya-ta-hrylya",
            //            "/molochni-produkty/syry-z-plisnyavoyu",
            //            "/molochni-produkty/syry-rozsilni",
            //            "/molochni-produkty/smetana-1",
            //            "/morozyvo-2/morozyvo-1",
            //            "/ovochi/zamorozheni-ovochi-1",
            //            "/ovochi/konservovani-ovochi-1",
            //            "/ovochi/ovochi-svizhi",
            //            "/pryhotuvannya-izhi-ta-vypikannya/inshi-olii",
            //            "/pryhotuvannya-izhi-ta-vypikannya/boroshno",
            //            "/pryhotuvannya-izhi-ta-vypikannya/zhyry-dlya-pryhotuvannya-izhi-ta-vypichky",
            //            "/pryhotuvannya-izhi-ta-vypikannya/zapravky-dipy",
            //            "/pryhotuvannya-izhi-ta-vypikannya/kondyterski-dobavky",
            //            "/pryhotuvannya-izhi-ta-vypikannya/olyvkova-oliya",
            //            "/pryhotuvannya-izhi-ta-vypikannya/otsty",
            //            "/pryhotuvannya-izhi-ta-vypikannya/pidsolodzhuvachi-med",
            //            "/pryhotuvannya-izhi-ta-vypikannya/smakovi-dobavky-spetsii-bulyony-prypravy",
            //            "/pryhotuvannya-izhi-ta-vypikannya/sousy-ketchupy-tomatnfa-pasta-hirchytsi-mayonezy",
            //            "/pryhotuvannya-izhi-ta-vypikannya/sukhi-sumishi-dlya-pryhotuvannya-izhi-ta-vypichky",
            //            "/pryhotuvannya-izhi-ta-vypikannya/tsukor",
            //            "/pryhotuvannya-izhi-ta-vypikannya/yaytsya",
            //            "/roslynni-molochni-produkty/yohurty-ta-yohurtovi-napoi",
            //            "/roslynni-molochni-produkty/pudynhy-ta-deserty",
            //            "/roslynni-molochni-produkty/roslynne-moloko",
            //            "/roslynni-molochni-produkty/syry-svizhyy-syr-ta-vershky",
            //            "/roslynni-molochni-produkty/sukhe-moloko",
            //            "/sneky/arakhisovi-ta-kukurudzyani-palychky",
            //            "/sneky/krekery-ta-dribni-sneky-bez-horikhiv",
            //            "/sneky/chypsy",
            //            "/solodoshchi-1/pechyvo-ta-vafli",
            //            "/solodoshchi-1/solodki-pasty",
            //            "/solodoshchi-1/torty-ta-deserty",
            //            "/solodoshchi-1/tsukerky-ta-zhuvalni-humky",
            //            "/solodoshchi-1/shokolad-ta-shokoladni-tsukerky",
            //            "/solodoshchi-1/shokoladni-batonchyky",
            //            "/ctravy-ta-harniry/izha-shvydkoho-pryhotuvannya",
            //            "/ctravy-ta-harniry/harniry-kartoplya-kartoplyani-napivfabrykaty-kartoplyane-pyure",
            //            "/ctravy-ta-harniry/harniry-knedliky-noki-ta-halushky-bez-nachynok",
            //            "/ctravy-ta-harniry/harniry-makarony",
            //            "/ctravy-ta-harniry/harniry-rys",
            //            "/ctravy-ta-harniry/hotovi-stravy-ta-napivfabrykaty",
            //            "/ctravy-ta-harniry/zmishani-salaty",
            //            "/ctravy-ta-harniry/keto-diyeta",
            //            "/ctravy-ta-harniry/supy-1",
            //            "/ctravy-ta-harniry/fastfud-1",
            //            "/frukty-1/dzhemy-konfityury-i-marmelady",
            //            "/frukty-1/pyure-ta-dytyache-kharchuvannya",
            //            "/frukty-1/sukhofrukty-1",
            //            "/frukty-1/frukty-zamorozheni",
            //            "/frukty-1/frukty-konservovani",
            //            "/frukty-1/frukty-svizhi",
            //            "/kharchovi-dobavky/vitaminy-mineraly-syropy-krapli",
            //            "/kharchovi-dobavky/klitkovyna",
            //            "/kharchovi-dobavky/sportyvni-dobavky",
            //            "/kharchovi-dobavky/funktsionalni-napoi",
            //            "/khlibobulochni-vyroby-1/bahety",
            //            "/khlibobulochni-vyroby-1/vypecheni-ta-khrustki-khlibtsi",
            //            "/khlibobulochni-vyroby-1/ekstruziyni-khlibtsi",
            //            "/khlibobulochni-vyroby-1/lavashi-ta-tortylya",
            //            "/khlibobulochni-vyroby-1/solodka-vypichka-velyka",
            //            "/khlibobulochni-vyroby-1/solodka-vypichka-mala",
            //            "/khlibobulochni-vyroby-1/solona-vypichka-z-nachynkoyu-zakusky",
            //            "/khlibobulochni-vyroby-1/khlib-osoblyvyy",
            //            "/khlibobulochni-vyroby-1/khlib-tostovyy-ta-batony",
            //            "/khlibobulochni-vyroby-1/khlib-tradytsiynyy",
            '/khlibobulochni-vyroby-1/chiabata-ta-nesolodki-bulochky',
        ];

        $client = Client::createChromeClient();

        foreach ($cats as $cat) {
            $this->info('Category '.$cat.' was loaded');
            foreach (range(1, 10000000) as $page) {
                $crawler = $client->request('GET', "https://www.tablycjakalorijnosti.com.ua$cat?page=".$page);
                $this->info('Page '.$page.' was loaded');

                $nodes = $crawler->filter('tr.p-table-bg-hover');
                if ($nodes->count() > 0) {
                    $nodes->each(function ($node) use ($client) {
                        $title = '';
                        $node->filter('td')->eq(0)->each(function ($td) use ($client, &$title) {
                            $text = $client->executeScript('return arguments[0].textContent;', [$td->getElement(0)]);
                            $title = trim($text);
                        });
                        $calories = '';
                        $node->filter('td')->eq(1)->each(function ($td) use ($client, &$calories) {
                            $text = (float) $client->executeScript('return arguments[0].textContent;', [$td->getElement(0)]);
                            $calories = trim($text);
                        });
                        $proteins = '';
                        $node->filter('td')->eq(2)->each(function ($td) use ($client, &$proteins) {
                            $text = (float) $client->executeScript('return arguments[0].textContent;', [$td->getElement(0)]);
                            $proteins = trim($text);
                        });
                        $carbohydrates = '';
                        $node->filter('td')->eq(3)->each(function ($td) use ($client, &$carbohydrates) {
                            $text = (float) $client->executeScript('return arguments[0].textContent;', [$td->getElement(0)]);
                            $carbohydrates = trim($text);
                        });
                        $fats = '';
                        $node->filter('td')->eq(4)->each(function ($td) use ($client, &$fats) {
                            $text = (float) $client->executeScript('return arguments[0].textContent;', [$td->getElement(0)]);
                            $fats = trim($text);
                        });
                        $product = Product::firstOrCreate([
                            'title' => $title,
                            'calories' => $calories,
                            'proteins' => $proteins,
                            'carbohydrates' => $carbohydrates,
                            'fats' => $fats,
                            'base' => true,
                        ]);
                        if ($product->wasRecentlyCreated) {
                            $this->info('Product \''.$product->title.'\' was created');
                        } else {
                            $this->info('Product  \''.$product->title.'\' was updated');
                        }
                    });
                } else {
                    $this->warn('No elements found for page '.$page);
                    break;
                }
            }
        }
    }
}
