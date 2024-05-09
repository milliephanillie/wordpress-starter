<?php

// This is an example of the HTML that I need to scrape. I need to get each link value and put it as a post title.

// <div id="az-slider">
// 	<div id="inner-slider">
// 									<div class="letter-section" id="letter-A">
// 					<h2>
// 						<span>A</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="aborted-human-fetal-dna-ingredient/">Aborted Human Fetal DNA</a>
// 							</li>
// 													<li>
// 								<a href="abortion/">Abortion</a>
// 							</li>
// 													<li>
// 								<a href="acute-flaccid-paralysis/">Acute Flaccid Paralysis</a>
// 							</li>
// 													<li>
// 								<a href="adem/">ADEM</a>
// 							</li>
// 													<li>
// 								<a href="allergies/">Allergies</a>
// 							</li>
// 													<li>
// 								<a href="als/">ALS</a>
// 							</li>
// 													<li>
// 								<a href="aluminum/">Aluminum/Aluminium</a>
// 							</li>
// 													<li>
// 								<a href="alzheimers/">Alzheimer’s</a>
// 							</li>
// 													<li>
// 								<a href="anaphylaxis/">Anaphylaxis</a>
// 							</li>
// 													<li>
// 								<a href="anemia/">Anemia</a>
// 							</li>
// 													<li>
// 								<a href="animals/">Animals</a>
// 							</li>
// 													<li>
// 								<a href="anthrax/">Anthrax</a>
// 							</li>
// 													<li>
// 								<a href="arthritis/">Arthritis</a>
// 							</li>
// 													<li>
// 								<a href="asia/">ASIA</a>
// 							</li>
// 													<li>
// 								<a href="asthma/">Asthma</a>
// 							</li>
// 													<li>
// 								<a href="attention-deficit-disorder/">Attention Deficit Disorder</a>
// 							</li>
// 													<li>
// 								<a href="autism/">Autism</a>
// 							</li>
// 													<li>
// 								<a href="autoimmunity/">Autoimmunity</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-B">
// 					<h2>
// 						<span>B</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="bcg/">BCG</a>
// 							</li>
// 													<li>
// 								<a href="bells-palsy/">Bell’s Palsy</a>
// 							</li>
// 													<li>
// 								<a href="breastfeeding/">Breastfeeding</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-C">
// 					<h2>
// 						<span>C</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="cancer/">Cancer</a>
// 							</li>
// 													<li>
// 								<a href="cardiorespiratory/">Cardiorespiratory</a>
// 							</li>
// 													<li>
// 								<a href="cardiovascular/">Cardiovascular</a>
// 							</li>
// 													<li>
// 								<a href="cdc/">CDC</a>
// 							</li>
// 													<li>
// 								<a href="chickenpox/">Chickenpox</a>
// 							</li>
// 													<li>
// 								<a href="cholera/">Cholera</a>
// 							</li>
// 													<li>
// 								<a href="chronic-fatigue-syndrome/">Chronic Fatigue Syndrome</a>
// 							</li>
// 													<li>
// 								<a href="contamination/">Contamination</a>
// 							</li>
// 													<li>
// 								<a href="corruption/">Corruption</a>
// 							</li>
// 													<li>
// 								<a href="crps/">CRPS</a>
// 							</li>
// 													<li>
// 								<a href="cutter/">Cutter Incident</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-D">
// 					<h2>
// 						<span>D</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="death/">Death</a>
// 							</li>
// 													<li>
// 								<a href="dermatological/">Dermatological</a>
// 							</li>
// 													<li>
// 								<a href="diabetes/">Diabetes</a>
// 							</li>
// 													<li>
// 								<a href="dtap/">DTaP</a>
// 							</li>
// 													<li>
// 								<a href="dtp/">DTP</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-E">
// 					<h2>
// 						<span>E</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="eczema/">Eczema</a>
// 							</li>
// 													<li>
// 								<a href="encephalitis/">Encephalitis</a>
// 							</li>
// 													<li>
// 								<a href="encephalomyelitis/">Encephalomyelitis</a>
// 							</li>
// 													<li>
// 								<a href="encephalopathy/">Encephalopathy</a>
// 							</li>
// 													<li>
// 								<a href="error/">Error</a>
// 							</li>
// 													<li>
// 								<a href="eyes/">Eyes</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-F">
// 					<h2>
// 						<span>F</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="failure/">Failure</a>
// 							</li>
// 													<li>
// 								<a href="featured-studies/">Featured Studies 🛑</a>
// 							</li>
// 													<li>
// 								<a href="fetal-death/">Fetal Death</a>
// 							</li>
// 													<li>
// 								<a href="fibromyalgia/">Fibromyalgia</a>
// 							</li>
// 													<li>
// 								<a href="financial/">Financial Incentives</a>
// 							</li>
// 													<li>
// 								<a href="flu/">Flu</a>
// 							</li>
// 													<li>
// 								<a href="food-allergies/">Food Allergies</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-G">
// 					<h2>
// 						<span>G</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="gardasil/">Gardasil</a>
// 							</li>
// 													<li>
// 								<a href="gastrointestinal/">Gastrointestinal</a>
// 							</li>
// 													<li>
// 								<a href="guillain-barre/">Guillain-Barre</a>
// 							</li>
// 													<li>
// 								<a href="gulf-war-syndrome/">Gulf War Syndrome</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-H">
// 					<h2>
// 						<span>H</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="h1n1/">H1N1</a>
// 							</li>
// 													<li>
// 								<a href="hair-loss/">Hair Loss</a>
// 							</li>
// 													<li>
// 								<a href="hashimotos/">Hashimoto’s</a>
// 							</li>
// 													<li>
// 								<a href="hearing-loss/">Hearing Loss</a>
// 							</li>
// 													<li>
// 								<a href="hepatitis/">Hepatitis</a>
// 							</li>
// 													<li>
// 								<a href="hepatitis-a/">Hepatitis A</a>
// 							</li>
// 													<li>
// 								<a href="hepatitis-b/">Hepatitis B</a>
// 							</li>
// 													<li>
// 								<a href="hexavalent/">Hexavalent</a>
// 							</li>
// 													<li>
// 								<a href="hib/">Hib</a>
// 							</li>
// 													<li>
// 								<a href="hla/">HLA</a>
// 							</li>
// 													<li>
// 								<a href="2670-2/">HPV</a>
// 							</li>
// 													<li>
// 								<a href="hypotonic-hyporesponsive-episodes/">Hypotonic-Hyporesponsive Episodes</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-I">
// 					<h2>
// 						<span>I</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="immune/">Immune System</a>
// 							</li>
// 													<li>
// 								<a href="influenza/">Influenza</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-J">
// 					<h2>
// 						<span>J</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="japanese-encephalitis/">Japanese Encephalitis</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-K">
// 					<h2>
// 						<span>K</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="k/">K</a>
// 							</li>
// 													<li>
// 								<a href="kawasaki/">Kawasaki</a>
// 							</li>
// 													<li>
// 								<a href="kidney/">Kidney</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-L">
// 					<h2>
// 						<span>L</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="leprosy/">Leprosy</a>
// 							</li>
// 													<li>
// 								<a href="liver/">Liver</a>
// 							</li>
// 													<li>
// 								<a href="lung/">Lung</a>
// 							</li>
// 													<li>
// 								<a href="lupus/">Lupus</a>
// 							</li>
// 													<li>
// 								<a href="lyme/">Lyme</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-M">
// 					<h2>
// 						<span>M</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="macrophagic-myofasciitis/">Macrophagic Myofasciitis</a>
// 							</li>
// 													<li>
// 								<a href="measles/">Measles</a>
// 							</li>
// 													<li>
// 								<a href="meningitis/">Meningitis</a>
// 							</li>
// 													<li>
// 								<a href="meningococcal/">Meningococcal</a>
// 							</li>
// 													<li>
// 								<a href="mercury/">Mercury</a>
// 							</li>
// 													<li>
// 								<a href="miscellaneous/">Miscellaneous</a>
// 							</li>
// 													<li>
// 								<a href="mitochondria/">Mitochondria</a>
// 							</li>
// 													<li>
// 								<a href="mmr/">MMR</a>
// 							</li>
// 													<li>
// 								<a href="mmrv/">MMRV</a>
// 							</li>
// 													<li>
// 								<a href="molecular-mimicry/">Molecular Mimicry</a>
// 							</li>
// 													<li>
// 								<a href="multiple-sclerosis/">Multiple Sclerosis</a>
// 							</li>
// 													<li>
// 								<a href="mumps/">Mumps</a>
// 							</li>
// 													<li>
// 								<a href="musculoskeletal/">Musculoskeletal</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-N">
// 					<h2>
// 						<span>N</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="narcolepsy/">Narcolepsy</a>
// 							</li>
// 													<li>
// 								<a href="neurodevelopmental/">Neurodevelopmental</a>
// 							</li>
// 													<li>
// 								<a href="neurological/">Neurological</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-O">
// 					<h2>
// 						<span>O</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="ophthalmological/">Ophthalmological</a>
// 							</li>
// 													<li>
// 								<a href="ovarian/">Ovarian</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-P">
// 					<h2>
// 						<span>P</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="pancreatitis/">Pancreatitis</a>
// 							</li>
// 													<li>
// 								<a href="paralysis/">Paralysis</a>
// 							</li>
// 													<li>
// 								<a href="parkinsonism/">Parkinsonism</a>
// 							</li>
// 													<li>
// 								<a href="parvo/">Parvo</a>
// 							</li>
// 													<li>
// 								<a href="peanut/">Peanut</a>
// 							</li>
// 													<li>
// 								<a href="pertussis/">Pertussis</a>
// 							</li>
// 													<li>
// 								<a href="pneumococcal/">Pneumococcal</a>
// 							</li>
// 													<li>
// 								<a href="pneumonia/">Pneumonia</a>
// 							</li>
// 													<li>
// 								<a href="polio/">Polio</a>
// 							</li>
// 													<li>
// 								<a href="pots/">POTS</a>
// 							</li>
// 													<li>
// 								<a href="pregnancy/">Pregnancy</a>
// 							</li>
// 													<li>
// 								<a href="premature/">Premature Infants</a>
// 							</li>
// 													<li>
// 								<a href="psychiatric/">Psychiatric</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 																	<div class="letter-section" id="letter-R">
// 					<h2>
// 						<span>R</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="rabies/">Rabies</a>
// 							</li>
// 													<li>
// 								<a href="recently-vaccinated-shedding-and-injuring-others/">Recently Vaccinated Shedding and Injuring Others</a>
// 							</li>
// 													<li>
// 								<a href="respiratory/">Respiratory</a>
// 							</li>
// 													<li>
// 								<a href="rhogam/">Rhogam</a>
// 							</li>
// 													<li>
// 								<a href="rotavirus/">Rotavirus</a>
// 							</li>
// 													<li>
// 								<a href="rubella/">Rubella</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-S">
// 					<h2>
// 						<span>S</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="seizures/">Seizures</a>
// 							</li>
// 													<li>
// 								<a href="sexual-and-genital-transmission-of-vaccinia/">Sexual Transmission of Vaccinia</a>
// 							</li>
// 													<li>
// 								<a href="shaken-baby-syndrome/">Shaken Baby Syndrome</a>
// 							</li>
// 													<li>
// 								<a href="shedding/">Shedding</a>
// 							</li>
// 													<li>
// 								<a href="shingles/">Shingles</a>
// 							</li>
// 													<li>
// 								<a href="sirva-shoulder-injury/">SIRVA (Shoulder Injury)</a>
// 							</li>
// 													<li>
// 								<a href="sjogrens/">Sjogren’s</a>
// 							</li>
// 													<li>
// 								<a href="small-fiber-neuropathy/">Small Fiber Neuropathy</a>
// 							</li>
// 													<li>
// 								<a href="smallpox/">Smallpox</a>
// 							</li>
// 													<li>
// 								<a href="stroke/">Stroke</a>
// 							</li>
// 													<li>
// 								<a href="sudden-infant-death-syndrome/">Sudden Infant Death Syndrome</a>
// 							</li>
// 													<li>
// 								<a href="sv40-simian-virus/">SV40 Simian Virus</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-T">
// 					<h2>
// 						<span>T</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="tdap/">Tdap</a>
// 							</li>
// 													<li>
// 								<a href="tetanus/">Tetanus</a>
// 							</li>
// 													<li>
// 								<a href="thimerosal/">Thimerosal/Thiomersal</a>
// 							</li>
// 													<li>
// 								<a href="thrombocytopenia/">Thrombocytopenia</a>
// 							</li>
// 													<li>
// 								<a href="thyroid/">Thyroid</a>
// 							</li>
// 													<li>
// 								<a href="tics/">Tics</a>
// 							</li>
// 													<li>
// 								<a href="transverse-myelitis/">Transverse Myelitis</a>
// 							</li>
// 													<li>
// 								<a href="tuberculosis/">Tuberculosis</a>
// 							</li>
// 													<li>
// 								<a href="typhoid/">Typhoid</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 																	<div class="letter-section" id="letter-V">
// 					<h2>
// 						<span>V</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="vaers/">VAERS</a>
// 							</li>
// 													<li>
// 								<a href="varicella-chickenpox/">Varicella (Chickenpox)</a>
// 							</li>
// 													<li>
// 								<a href="varicella-zoster-shingles/">Varicella Zoster (Shingles)</a>
// 							</li>
// 													<li>
// 								<a href="veterinary/">Veterinary</a>
// 							</li>
// 													<li>
// 								<a href="vitamin-k/">Vitamin K</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-W">
// 					<h2>
// 						<span>W</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="whooping-cough/">Whooping Cough</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 																	<div class="letter-section" id="letter-Y">
// 					<h2>
// 						<span>Y</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="yellow-fever/">Yellow Fever</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 											</div>
// </div>

class TWW_Glossary {
    const GLOSSARY_URL = 'https://vaccine.guide/';

    public function __construct() {
        add_action('init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route('tww-glossary/v1', '/scrape', [
            'methods' => 'GET',
            'callback' => [$this, 'scrape_glossary'],
            'permission_callback' => [$this, 'validate_user'],
        ]);
    }

    public function scrape_glossary() {
        $html = file_get_contents(self::GLOSSARY_URL);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $sections = $xpath->query('//div[@id="inner-slider"]/div[@class="letter-section"]');
        $posts = [];

        foreach($sections as $section) {
            $letter = $section->getElementsByTagName('span')[0]->nodeValue;
            $links = $section->getElementsByTagName('a');

            foreach($links as $link) {
                $posts[] = [
                    'title' => $link->nodeValue,
                    'slug' => $link->getAttribute('href'),
                    'letter' => $letter,
                ];
            }
        }

        return $posts;
    }

    public function insert_post() {

    }
    
}