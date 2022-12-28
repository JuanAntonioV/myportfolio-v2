import Button from "@/js/components/buttons/Button";
import TabMenu from "@/js/components/tabs/TabMenu";
import {useState} from "react";
import SocialMediaSticky from "@/js/components/features/SocialMediaSticky";
import EmailSticky from "@/js/components/features/EmailSticky";

const HomePage = () => {

    const [activeTab, setActiveTab] = useState(0);

    const tabs = [
        {
            id: 1,
            title: 'Tab 1',
        },
        {
            id: 2,
            title: 'Tab 2',
        },
        {
            id: 3,
            title: 'Tab 3',
        }
    ]

    return (
        <div className={'text-center'}>
            <Button>
                Get In Touch
            </Button>

            <div className="mt-8">
                <TabMenu tabs={tabs} active={activeTab} onActive={setActiveTab}/>
                <TabMenu tabs={tabs} active={activeTab} onActive={setActiveTab} vertical/>
            </div>

            <div className="mt-8">
                <SocialMediaSticky/>
                <EmailSticky/>
            </div>
        </div>
    );
};

export default HomePage;
